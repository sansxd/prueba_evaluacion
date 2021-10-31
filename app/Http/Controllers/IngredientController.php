<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ingredient::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:App\Models\Ingredient,name',
            'price'=>'required|integer|numeric',
        ]);
        $ingredient = new Ingredient;
        $ingredient->name = $request->name;
        $ingredient->price = $request->price;
        $ingredient->save();

        return $ingredient;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ingredient::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //buscando id de ingrediente
        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name;
        $ingredient->save();
        return $ingredient;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient != null) {
            $ingredient->delete();
            return response()->json([
            'message' => 'delete success',
            'ingredient' => $ingredient
            ]);
        }
        return response()->json([
            'message' => 'id no found',
        ]);
    }
    public function search(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $ingredientByDate = Ingredient::query()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();
        //creados despues de una fecha dada
        // $ingredient = Ingredient::where('created_at','>',$created_at)->get();
        return $ingredientByDate;
    }
}

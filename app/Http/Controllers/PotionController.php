<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Potion;
use App\Http\Resources\PotionResource;

class PotionController extends Controller
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
        $data = PotionResource::collection(Potion::all());
        return $data;
    }
    public function add(Request $request,$id)
    {
        $request->validate([
            'ingredient_id'=>'required|integer|numeric',
            'amount'=>'required|integer',
        ]);
        $amount = $request->amount;
        $ingredient_id = $request->ingredient_id;
        
        $potion = Potion::find($id);
        $potion->ingredients()->attach($ingredient_id,['amount' => $amount]);
        
        $data = new PotionResource($potion);
        return response()->json([
            'message' => 'relationship added',
            'potion' => $data
        ]);
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
            'name'=>'required|unique:App\Models\Potion,name',
        ]);
        $potion = new Potion;
        $potion->name = $request->name;
        $potion->save();

        return $potion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $potion = Potion::with('ingredients')->findOrFail($id);
        $data = new PotionResource(Potion::findOrFail($id));
        return $data;

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
        $potion = Potion::find($id);
        $potion->name = $request->name;
        $potion->save();
        return $potion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $potion = Potion::find($id);
        if ($potion != null) {
            $potion->delete();
            return response()->json([
            'message' => 'delete success',
            'potion' => $potion
            ]);
        }
        return response()->json([
            'message' => 'id no found',
        ]);
    }
}

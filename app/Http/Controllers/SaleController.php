<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\SaleDetail;
use App\Models\Sale;
use App\Http\Resources\SaleResource;

use Illuminate\Http\Request;

class SaleController extends Controller
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
        $data = SaleResource::collection(Sale::all());
        return $data;
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
            'client_id' => 'required|integer|numeric',
            'sale_id'=> 'required|integer|numeric',
            'potion_id'=>'required|integer|numeric',
            'amount'=>'required|numeric',
            'sub_total'=>'required|numeric',
            'total'=>'required|numeric',
        ]);

        $sale = new Sale;
        $sale->client_id = $request->client_id;
        $sale->total = $request->total;
        $sale->save();

        $id_sale = $sale->id;
        
        $saleDetail = new SaleDetail;
        $saleDetail->sale_id = $id_sale;
        $saleDetail->potion_id = $request->potion_id;
        $saleDetail->amount = $request->amount;
        $saleDetail->sub_total = $request->sub_total;
        $saleDetail->save();
        return $saleDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

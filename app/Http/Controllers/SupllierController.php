<?php

namespace App\Http\Controllers;
use App\Models\orderTosupllier;
use App\Models\supllier;
use App\Models\products;
use App\Models\orderDetails;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

use Illuminate\Http\Request;

class SupllierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());


            $supllier=supllier::get();
            $allproduct=products::where('branchs_id',Auth()->User()->branchs_id)->get();
        $data=[
        "allcustomers"=>  $supllier,
        "allproduct"=> $allproduct
        ];
       // return $data;
            return  view('products.Purchase_order_of_resources',compact('data'));
        
           }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supllier  $supllier
     * @return \Illuminate\Http\Response
     */
    public function show( $supllier)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $customerdata=supllier::find($supllier);

        return   json_encode($customerdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supllier  $supllier
     * @return \Illuminate\Http\Response
     */
    public function edit( $supllier)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $orderdetails=orderDetails::where('order_owner',$supllier)->get();
       $sepllierdata=supllier::find($orderdetails[0]->supllier->suplier_id);
       $data=[
        'supllierdata'=>$sepllierdata,
        'productsdata'=>$orderdetails
       ];
//return $data;
        return view('supplier.print_products_to_supplier',compact('data')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supllier  $supllier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supllier $supllier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supllier  $supllier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supllier $supllier)
    {
        //
    }
}

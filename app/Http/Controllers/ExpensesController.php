<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
$expense=        expenses::create([
            'user_id'=>Auth()->user()->id,
            'Pay_Method_Name'=>$request->pay,
            'branchs_id'=>Auth()->user()->branchs_id,
            'Reasonforspendingmoney'=>$request->reasone,
            'created_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'Theـamountـpaid'=>$request->cashreceived
        ]);
        $data=[
            'transaction'=>[
                'user'=>Auth()->user()->name,
                'Pay_Method_Name'=>$request->pay,
                'Theـamountـpaid'=>$request->cashreceived,
                'Reasonforspendingmoney'=>$request->reasone,

            ],
        ];
        return view('acountes.cash expense',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function ExpensesOwner(Request $request)
    {
        //
        $expense=        expenses::create([
            'user_id'=>Auth()->user()->id,
            'Pay_Method_Name'=>$request->pay,
            'Reasonforspendingmoney'=>$request->reasone,
            'created_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'Theـamountـpaid'=>$request->cashreceived
        ]);
        $data=[
            'transaction'=>[
                'user'=>Auth()->user()->name,
                'Pay_Method_Name'=>$request->pay,
                'Theـamountـpaid'=>$request->cashreceived,
                'Reasonforspendingmoney'=>$request->reasone,

            ],
        ];
        return view('acountes.Expensesowner',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenses $expenses)
    {
        //
    }
}

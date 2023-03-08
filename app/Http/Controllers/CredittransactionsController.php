<?php

namespace App\Http\Controllers;

use App\Models\credittransactions;
use App\Models\transactiontosuplliers;

use App\Models\customers;
use App\Models\supllier;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;


class CredittransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //
     //   return $request;
        $clientId=$request->clientNosearch=='-'?$request->clientnamesearch:$request->clientNosearch;
        //    return $clientId;

        $createTransaction=   credittransactions::create(
            [
'user_id'=>Auth()->user()->id,
'customer_id'=>  $clientId,
'recive_amount'=> $request->cashreceived   ,
'branchs_id'=>Auth()->user()->branchs_id,
'pay_method'=> $request->pay,  
'Pay_Method_Name'=>$request->pay,
'created_at'  =>  \Carbon\Carbon::now()->addHours(3), 
'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 
        ]
            );
            $customerdata=customers::find( $clientId);

            $updateCustomer=customers::where('id',$request->clientnamesearch)->update(
                [
            'Balance'=>$customerdata->Balance-$request->cashreceived
                ]
            );
            $allcustomers=customers::get();
            $customerdata=customers::find( $clientId);

            $data=[
                "transaction"=>[
                    'id'=> $createTransaction->id ,
'name'=>$customerdata->name,
'Limit_credit'=>$customerdata->Limit_credit,
'Balance'=>$customerdata->Balance,
'method_pay'=>$request->pay,
'recive_amount'=>$request->cashreceived
                ],
                "allcustomers"=>  $allcustomers,
            ];
           // return $data['transaction']['name'];
    return view('acountes.voncher',compact('data'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // return $request;
        $suplliertId=$request->clientNosearch=='-'?$request->clientnamesearch:$request->clientNosearch;

        $transactiontosupllier= transactiontosuplliers::create(
        [
            'user_id'=>Auth()->user()->id,
            'branchs_id'=>Auth()->user()->branchs_id,
            'suplier_id'=>$suplliertId,
            'paidـamount'=>$request->cashreceived,
            'Pay_Method_Name'=> $request->pay,  
            'created_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 
        ]
        );
        $supllierIn_debt=  supllier::find($suplliertId);
            supllier::where('id',$suplliertId)->update(
                [
'In_debt'=> $supllierIn_debt->In_debt-$request->cashreceived,
'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 

                ]
                );
                $allsuplliers=supllier::get();
                $supllierIn_debt=  supllier::find($suplliertId);

                $data=[
                    "transaction"=>[
                        'id'=>  $transactiontosupllier->id ,
                        'name'=>$supllierIn_debt->name,
                        'Balance'=>$supllierIn_debt->In_debt,
                        'method_pay'=>$request->pay,
                        'paid_amount'=>$request->cashreceived
                                        ],
                
                    "allsupllier"=>  $allsuplliers,
                ];
                        return view('acountes.reciept_decoment',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\credittransactions  $credittransactions
     * @return \Illuminate\Http\Response
     */
    public function show(credittransactions $credittransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\credittransactions  $credittransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(credittransactions $credittransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\credittransactions  $credittransactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, credittransactions $credittransactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\credittransactions  $credittransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(credittransactions $credittransactions)
    {
        //
    }
}

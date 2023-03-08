<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactiontosuplliers;
use App\Models\supllier;
use App\Models\User;
use App\Models\customers;
use App\Models\credittransactions;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

class AcountesController extends Controller
{
    //

    public function voncher(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $allcustomers=customers::get();
        $data=[
            "transaction"=>[],
            "allcustomers"=>  $allcustomers,
        ];
return view('acountes.voncher',compact('data'));
    }

    public function cashEcprnse(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $allcustomers=User::get();
        $data=[
            'transaction'=>[],
            "allusers"=>  $allcustomers,
        ];
        return view('acountes.cash expense',compact('data'));
 
    }

    public function income(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $allcustomers=customers::get();
        $data=[
            "transaction"=>  [],
        ];
        return view('acountes.Expensesowner',compact('data'));
  
    }

    public function reciept_decoument(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $allcustomers=supllier::get();
$data=[
    "transaction"=>[],

    "allsupllier"=>  $allcustomers,
];
        return view('acountes.reciept_decoment',compact('data'));

    }

    public  function print_voucher($id)
    {
        $transactiontosupllier= transactiontosuplliers::find($id);

        $supllierdata=supllier::find( $transactiontosupllier->suplier_id);
//return  $supllierdata;
        $data=[
            "transaction"=>[
'name'=>$supllierdata->name,
'Limit_credit'=>$supllierdata->Limit_credit,
'Balance'=>$supllierdata->In_debt,
'camp_name'=> $supllierdata->comp_name,
'camp_phone'=> $supllierdata->phone,
'date'=> $transactiontosupllier->created_at ,
'method_pay'=>$transactiontosupllier->Pay_Method_Name,
'paid_amount'=>$transactiontosupllier->paidـamount
            ],
        ];
        return view('acountes.print_voucher_to_supplier',compact('data'));
        # code...
    }


    
    public  function print_reciept_ducoument($id)
    {
        $transactiontocustomer=credittransactions::find($id);
//return $transactiontocustomer;
        $customerdata=customers::find( $transactiontocustomer->customer_id);
        $data=[
            "transaction"=>[
'name'=>$customerdata->name,
'Limit_credit'=>$customerdata->Limit_credit,
'Balance'=>$customerdata->Balance,
'date'=> $transactiontocustomer->created_at ,
'method_pay'=>$transactiontocustomer->Pay_Method_Name,
'paid_amount'=>$transactiontocustomer->recive_amount
            ],
        ];
        return view('acountes.print_reciept_decoment_to_customer',compact('data'));
        # code...
    }
    
}

<?php

namespace App\Http\Controllers;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;
use App\Models\offer_price_to_customer_items;
use Illuminate\Http\Request;
use App\Models\invoices;
use App\Models\orderDetails;
use App\Models\credittransactions;
use App\Models\customers;
use App\Models\order_price_from_supplier;
use App\Models\resource_purchases;
use App\Models\sales;
use App\Models\supllier;
use App\Models\expenses;
use App\Models\orderTosupllier;
use App\Models\return_sales;
use App\Models\offer_price_to_customer;
use  App\Models\transactiontosuplliers;
use App\Models\products;




class ReportController extends Controller
{
    //

    
    public function Delivery_notes()
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());
  
  return view('reports.Delivery_notes')  ;
  }

  

  public function Customersـexceededـgraceـperiod()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());
     $customers= customers::where('Balance','!=',0)->get();
     $Customersـexceededـgraceـperiod=[];
foreach($customers as $customer){
    $ffdate=$customer->updated_at;
    $tdate=\Carbon\Carbon::now()->addHours(3)::now();
    $start = \Carbon\Carbon::parse($ffdate);
    $end =  \Carbon\Carbon::parse($tdate);
    $diff_in_days = $end->diffInDays($start);
    if($diff_in_days>$customer->grace_period_in_days){
$Customersـexceededـgraceـperiod[]=$customer;
    }
    // $Customersـexceededـgraceـperiod
}
return view('reports.Customersـexceededـgraceـperiod',compact('Customersـexceededـgraceـperiod'))  ;
}
  public function VAT()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.VAT')  ;
}
  



  public function Best_selling_products()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Best_selling_products')  ;
}



public function budgetsheet()
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
   

return view('reports.budget sheet')  ;
}


  public function stockquantity()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.stockquantity')  ;
}
  




  public function shift_detailes()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.shift_detailes')  ;
}



  
  public function Supplier_credit_payment()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Supplier_credit_payment')  ;
}
  
  public function print_supplierList()
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());
  
  return view('reports.print_supplierList')  ;
  }
  
  public function customerـpurchases()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.customerـpurchases')  ;
}
  
public function credit_collection()
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.credit_collection')  ;
}


  public function purchasereports()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.purchasereports')  ;
}

  public function Purchasesـfromـsuppliers()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Purchasesـfromـsuppliers')  ;
}


public function Refundـofـresourceـpurchases()
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Refundـofـresourceـpurchases')  ;
}




  public function Requestـaـquoteـfromـtheـsupplier()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Requestـaـquoteـfromـtheـsupplier')  ;
}
  

  public function product_sales()
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.product_sales')  ;
}
  
  public function report_returns_sale()
  {
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    return view('reports.report_returns_sale')  ;
  }


  public function salesـprofits()
  {
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    return view('reports.salesـprofits')  ;
  }
  public function supplierList()
  {
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    return view('reports.supplierList')  ;
  }

  public function Expenses()
  {
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    return view('reports.Expenses')  ;
  }
  


  public function Creditsales()
  {
    app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Creditsales')  ;
}

public function employeeـsales()
{
  app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.employeeـsales')  ;
}

public function Requestـoffersـfromـsuppliers()
{
  app()->setLocale(LaravelLocalization::getCurrentLocale());

return view('reports.Requestـoffersـfromـsuppliers')  ;
}


public function report_offer_price_customer()
{
  app()->setLocale(LaravelLocalization::getCurrentLocale());
$Invoices=null;
return view('reports.report_offer_price_customer',compact('Invoices'))  ;
}




public function show_offer_price_customer(Request $request)
{
  //  return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $userId=$request->UserId;
    if($userId=='-'){
$Invoices=offer_price_to_customer::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

return view('reports.report_offer_price_customer',compact('Invoices'))->with('userId', $userId)   ;
     
    }
    $Invoices=offer_price_to_customer::where('customer_id', $userId)->get();
   return view('reports.report_offer_price_customer',compact('Invoices'))->with('userId', $userId)  ;
}


public function search_Delivery_notes(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$request->UserId;
    if($supplierId=='-'){
$Invoices=resource_purchases::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
    
return view('reports.Delivery_notes',compact('Invoices'))->with('supplierId', $supplierId)   ;
     
    }
    $Invoices=resource_purchases::where('orderId',$request->UserId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
   return view('reports.Delivery_notes',compact('Invoices'))->with('supplierId',$supplierId)  ;
}





public function search_shift_detailes(Request $request)
{
  // return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$request->UserId;
    if($request->branch=='-'&&$request->pay=='-'){
$Invoices=invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
    
return view('reports.shift_detailes',compact('Invoices'))->with('pay',[$request->pay,$request->branch]) ;
     
    }
    if($request->branch=='-'&&$request->pay=='-'){
        $Invoices=invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
        //return $Invoices;       
        return view('reports.shift_detailes',compact('Invoices'))->with('supplierId', $supplierId)   ;
             
            }
            elseif($request->branch!='-'&&$request->pay=='-'){
                $Invoices=invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
                //return $Invoices;
                    
                return view('reports.shift_detailes',compact('Invoices'))->with('pay',[$request->pay,$request->branch])  ;
                     
         }
         elseif($request->branch=='-'&&$request->pay!='-'){
            $Invoices=invoices::where('Pay',$request->pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
            //return $Invoices;
                
            return view('reports.shift_detailes',compact('Invoices'))->with('pay',[$request->pay,$request->branch])   ;
                 
     }
         else{
                        $Invoices=invoices::where('branchs_id',$request->branch)->where('Pay',$request->pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
                        //return $Invoices;
                           return view('reports.shift_detailes',compact('Invoices'))->with('pay',[$request->pay,$request->branch])  ;
                    }

}






public function search_Supplier_credit_payment(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $Invoices= transactiontosuplliers::where('suplier_id',$request->supplierId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
   return view('reports.Supplier_credit_payment',compact('Invoices'))->with('supplierId',$request->supplierId)  ;
}

public function printExpensesReportlast($branch,$startat,$end_at){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $start_at= str_split($startat,10);
    $end_at= str_split($end_at,10);
//return $request;
if($branch=='-'){
    $Invoices= expenses::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();

}else{
    $Invoices= expenses::where('branchs_id',$branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();

}
    return view('reports.printExpensesReport',compact('Invoices'))->with('branch',$branch)  ;
  }


public function printExpensesReport(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
//return $request;
if($request->branch=='-'){
    $Invoices= expenses::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}else{
    $Invoices= expenses::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
    return view('reports.Expenses',compact('Invoices'))->with('branch',$request->branch)  ;
  }

  public function search_stockquantity(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($request->branch=='-'){
        $products= products::get();
    
    }else{
        $products= products::where('branchs_id',$request->branch)->get();
    
    }
    return view('reports.stockquantity',compact('products'))->with('branch_id',$request->branch)  ;
}




public function search_Expenses(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
//return $request;
if($request->branch=='-'){
    $Invoices= expenses::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}else{
    $Invoices= expenses::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
    return view('reports.Expenses',compact('Invoices'))->with('branch_id',$request->branch)  ;
  }

  public function search_Best_selling_products(Request $request)
  {
      app()->setLocale(LaravelLocalization::getCurrentLocale());
      if($request->branch=='-'){
        $bestSaleing=products::orderBy('numberـofـsales', 'desc')->get();

      }
      else{
        $bestSaleing=products::where('branchs_id',$request->branch)->orderBy('numberـofـsales', 'desc')->get();

      }

 return view('reports.Best_selling_products',compact('bestSaleing'))->with('branch_id',$request->branch)  ;
 }



 





public function search_credit_collection(Request $request)
{
  // return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $UserId=$request->UserId;
    if($UserId=='-'){
$Invoices=credittransactions::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    
return view('reports.credit_collection',compact('Invoices'))->with('customer_id', $UserId)   ;
     
    }
    $Invoices=credittransactions::where('customer_id',$UserId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
   return view('reports.credit_collection',compact('Invoices'))->with('customer_id',$UserId)  ;
}






public function search_VAT (Request $request) {
    app()->setLocale(LaravelLocalization::getCurrentLocale());
//return $request;
$totalVatSales=0;
$totalVatPrachese=0;
if($request->branch=='-'){
    $invoices=invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

foreach($invoices as $invoice){
    $totalVatSales+=$invoice->Added_Value;
}
$resource_purchases=resource_purchases::
whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
foreach($resource_purchases as $resource_purchase){
    $ordersDetails=orderDetails::where('order_owner',$resource_purchase->orderId)->get();
    foreach($ordersDetails as $orderDetailes){
        $totalVatPrachese+=$orderDetailes->Added_Value*$orderDetailes->numberofpice;
    }
}
}
else{
    $invoices=invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    foreach($invoices as $invoice){
        $totalVatSales+=$invoice->Added_Value;
    }
    $resource_purchases=resource_purchases::where('branchs_id',$request->branch)->
    whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    foreach($resource_purchases as $resource_purchase){
        $ordersDetails=orderDetails::where('order_owner',$resource_purchase->orderId)->get();
        foreach($ordersDetails as $orderDetailes){
            $totalVatPrachese+=$orderDetailes->Added_Value*$orderDetailes->numberofpice;
        }
    }  
}

$data=[
    'start_at'=>$request->start_at,
    'end_at'=> $request->end_at,
    'totalVatSales'=>  $totalVatSales ,
    'totalVatPrachese'=> $totalVatPrachese 
];

return view('reports.VAT',compact('data'))->with('branch_id',$request->branch)  ;
}












public function search_purchasereports(Request $request)
{
  // return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$request->productname;
    if($supplierId=='-'){
$products=orderDetails::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
    
return view('reports.purchasereports',compact('products'))->with('supplierId', $supplierId)   ;
     
    }
    $products=orderDetails::where('product_id',$supplierId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
   return view('reports.purchasereports',compact('products'))->with('supplierId',$supplierId)  ;
}




public function search_customerـpurchases(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($request->branch=='-'&&$request->UserId=='-')
    {
        $Invoices=invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    }
    elseif($request->branch=='-'&&$request->UserId!='-')
{
    $Invoices=invoices::where('customer_id',$request->UserId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
elseif($request->branch!='-'&&$request->UserId=='-')
{
    $Invoices=invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
else{
    $Invoices=invoices::where('customer_id',$request->UserId)->where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
  
}
//return $products;
return view('reports.customerـpurchases',compact('Invoices'))->with('branch',[$request->UserId,$request->branch]) ->with('userid',[$request->UserId,$request->branch]) ;

}




public function search_Refundـofـresourceـpurchases(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
 if($request->branch!='-'){
    $Invoices=resource_purchases::where('branchs_id',$request->branch)->where('recoveredـpieces','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    return view('reports.Refundـofـresourceـpurchases',compact('Invoices'))->with('branch_id',$request->branch)  ;

 }
 else{
    $Invoices=resource_purchases::where('recoveredـpieces','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    return view('reports.Refundـofـresourceـpurchases',compact('Invoices')) ->with('branch_id',$request->branch)  ;

 }
//return $Invoices;
    
     

}







public function search_budgetsheet(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $salesdebit=0;
    $creadit=0;
    $cash=0;
    $shabka=0;
    $purchese_debit=0;
    $purchese_debit_paid=0;
    $customersdebit=customers::where('Balance','!=',0)->get();

    foreach($customersdebit as $customer){
    $salesdebit+=$customer->Balance;
   }

$month=$request->month>10?$request->month:'0'.$request->month;
$start_at=date("Y").'-'.$month.'-'.'01';
$end_at=date("Y").'-'.$month.'-'.'31';

$salescash=0;
$salescredit=0;
$salesshabka=0;

$purchesecash=0;
$purchesecredit=0;
$purcheseshabka=0;

$credittransaction_cash=0;
$credittransaction_shabka=0;


$transactiontosuplliers_cash=0;
$transactiontosuplliers_shabka=0;

$expenses_cash=0;
$expenses_shabka=0;

$Invoices=[];
$pirchese=[];
$credittransactions=[];
$transactiontosuplliers=[];
$expenses=[];
if($request->branch=='-'){
    $Invoices=invoices::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $pirchese=resource_purchases::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $credittransactions= credittransactions::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $transactiontosuplliers=transactiontosuplliers::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $expenses=expenses::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
}else{
    $Invoices=invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $pirchese=resource_purchases::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $credittransactions= credittransactions::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $transactiontosuplliers=transactiontosuplliers::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    $expenses=expenses::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
}
//return $Invoices;
foreach($Invoices as $invoice){
    if($invoice->Pay=='Cash'){
        $salescash+=$invoice->Price+$invoice->Added_Value;
    }
    elseif($invoice->Pay=='Credit'){
        $salescredit+=$invoice->Price+$invoice->Added_Value;
    }else{
        $salesshabka+=$invoice->Price+$invoice->Added_Value;
 
    }

}

foreach($pirchese as $purchese){


 if($purchese->Pay_Method_Name=='Cash'){
        $purchesecash+=$purchese->In_debt;
    }
    elseif($purchese->Pay_Method_Name=='Credit'){
        $purchesecredit+=$purchese->In_debt;
    }else{
        $purcheseshabka+=$purchese->In_debt;
 
    }
}

foreach($credittransactions as $credittransaction){
  
    if($credittransaction->pay_method	=='Cash'){
        $credittransaction_cash+=$credittransaction->recive_amount;
    }
    else{
        $credittransaction_shabka+=$credittransaction->recive_amount;

    }
}

    foreach($transactiontosuplliers as $transactiontosupllier){

        if($transactiontosupllier->Pay_Method_Name=='Cash'){
            $transactiontosuplliers_cash+=$transactiontosupllier->paidـamount;
        }
        else{
            $transactiontosuplliers_shabka+=$transactiontosupllier->paidـamount;
    
        } 

}


foreach($expenses as $expense){

    if($expense->Pay_Method_Name=='Cash'){
        $expenses_cash+=$expense->Theـamountـpaid;
    }
    else{
        $expenses_shabka+=$expense->Theـamountـpaid;

    }
}
$creadit_customers=customers::where('Balance','!=',0)->get();
$credit_suppliers=supllier::where('In_debt','!=',0)->get();
$creadit_customer_amount=0;
$credit_supplier_amount=0;

foreach($creadit_customers as $creadit_customer){
    $creadit_customer_amount+=  $creadit_customer->Balance; 
}

foreach($credit_suppliers as $credit_supplier){
    $credit_supplier_amount+=  $credit_supplier->In_debt; 
}
// return  $credit_supplier_amount;


$data=[
    'salescash'=>$salescash             ,
    'salescredit'=>$salescredit             ,
    'salesshabka'=> $salesshabka            ,


    'purchesecash'=>  $purchesecash           ,
    'purchesecredit'=> $purchesecredit            ,
    'purcheseshabka'=>$purcheseshabka             ,


    'credittransaction_cash'=> $credittransaction_cash            ,  
    'credittransaction_shabka'=> $credittransaction_shabka            ,

    'transactiontosuplliers_cash'=> $transactiontosuplliers_cash            ,
    'transactiontosuplliers_shabka'=>$transactiontosuplliers_shabka             ,

    'expenses_cash'=> $expenses_cash            ,
    'expenses_shabka'=> $expenses_shabka            ,

   'creadit_customer_amount'=> $creadit_customer_amount,
   'credit_supplier_amount'=>$credit_supplier_amount

];
//return $data;




    return view('reports.print_budget_sheet',compact('data'))->with('month',date("Y").'-'.$month)  ;
  }





public function search_Purchasesـfromـsuppliers(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $pay=$request->pay;
    $branch=$request->branch;

  
    if($pay=='-'&&$branch=='-'){
$Invoices=resource_purchases::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    
return view('reports.Purchasesـfromـsuppliers',compact('Invoices'))->with('pay', [$pay,$branch])   ;
     
    }
    elseif($pay!='-'&&$branch=='-'){
        $Invoices=resource_purchases::where('Pay_Method_Name',$pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    
return view('reports.Purchasesـfromـsuppliers',compact('Invoices'))->with('pay', [$pay,$branch])   ;
     
    }
    elseif($pay=='-'&&$branch!='-'){
        $Invoices=resource_purchases::where('branchs_id',$branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    
return view('reports.Purchasesـfromـsuppliers',compact('Invoices'))->with('pay',[$pay,$branch])   ;
     
    }
    $Invoices=resource_purchases::where('branchs_id',$branch)->where('Pay_Method_Name',$pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
   return view('reports.Purchasesـfromـsuppliers',compact('Invoices'))->with('pay',[$pay,$branch])  ;
}






public function search_Requestـaـquoteـfromـtheـsupplier(Request $request)
{
   //return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$request->supplierId;
    if($supplierId=='-'&&$request->branch=='-'){
$Invoices=order_price_from_supplier::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;
    
    }
    elseif($supplierId!='-'&&$request->branch=='-'){
        $Invoices=order_price_from_supplier::where('suplier_id',$supplierId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    }
    elseif($supplierId=='-'&&$request->branch!='-'){
        $Invoices=order_price_from_supplier::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    }else{
        $Invoices=order_price_from_supplier::where('suplier_id',$supplierId)->where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    }
//return $Invoices;
   return view('reports.Requestـaـquoteـfromـtheـsupplier',compact('Invoices'))->with('supplierId',[$supplierId,$request->branch])  ;
}




public function search_Requestـoffersـfromـsuppliers(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$request->supplierId;
    if($supplierId=='-'){
$Invoices=orderTosupllier::where('Limit_credit','')->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
//return $Invoices;        
return view('reports.Requestـoffersـfromـsuppliers',compact('Invoices'))->with('supplierId', $supplierId)   ;
     
    }
    $Invoices=orderTosupllier::where('Limit_credit','')->where('suplier_id',$request->supplierId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
    //return $Invoices;        

   return view('reports.Requestـoffersـfromـsuppliers',compact('Invoices'))->with('supplierId',$supplierId)  ;
}



public function search_product_sales(Request $request)
{
   // return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $productId=$request->productname=='-'?$request->productNo:$request->productname;
    if($productId=='-'){
        session()->flash('notfountreturnproduct','NOT FOUND');
$Invoices=[];
        return view('reports.product_sales',compact('Invoices'))->with('branch_Id',$request->branch)  ;
     
    }

else{
    if($request->branch=='-'&&$productId=='-')
    {
        $products=sales::where('product_id',$productId)->where('quantity','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

    }
    elseif($request->branch=='-'&&$productId!='-')
{
    $products=sales::where('product_id',$productId)->where('quantity','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
elseif($request->branch!='-'&&$productId=='-')
{
    $products=sales::where('branch_id',$request->branch)->where('quantity','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
else{
    $products=sales::where('product_id',$productId)->where('branch_id',$request->branch)->where('quantity','!=',0)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();
  
}
}


//return $products;
   return view('reports.product_sales',compact('products'))->with('branch_Id',$request->branch)  ;
}


public function viewnetworksales(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

   //  return $request;

   $Invoices= invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->where('Pay','SHABKA')->get();

//return $Invoices;
   return view('reports.networksales',compact('Invoices'))  ;
}

public function employeeSalesSearch(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

   //  return $request;

   $Invoices= invoices::where('user_id',$request->productname)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

//return $Invoices;
   return view('reports.employeeـsales',compact('Invoices'))  ;
}
public function viewCashsales(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $Invoices= invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->where('Pay','Cash')->get();


return view('reports.Cashsales',compact('Invoices'))  ;
}


public function search_report_returns_sale(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
if($request->branch=='-'){
    $Invoices= return_sales::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
else{
    $Invoices= return_sales::where('branch_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}

//return $Invoices;
return view('reports.report_returns_sale',compact('Invoices'))->with('branch_Id',$request->branch)  ;
}

public function salesـprofitssearch(Request $request)
{
   // return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
if($request->UserId=='-'&&$request->branch=='-'){

    $Invoices= invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();



}
elseif($request->UserId!='-'&&$request->branch=='-'){

    $Invoices= invoices::where('customer_id',$request->UserId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();



}


elseif($request->UserId=='-'&&$request->branch!='-'){

    $Invoices= invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();



}
else{
    $Invoices= invoices::where('branchs_id',$request->branch)->where('customer_id',$request->UserId)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}

return view('reports.salesـprofits',compact('Invoices'))->with('userId',$request->UserId)->with('branch_id',$request->branch)   ;
}


public function viewCreditsales(Request $request)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $Invoices= invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->where('Pay','Credit')->get();
    return view('reports.Creditsales',compact('Invoices'))  ;
}


public function print_Supplier_credit_payment($supplierId,$startat,$end_at)
{
   //return $request;
   $startat= str_split($startat,10);
   $end_at= str_split($end_at,10);
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $Invoices= transactiontosuplliers::where('suplier_id',$supplierId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
   return view('reports.print_Supplier_credit_payment',compact('Invoices'))  ;
}



public function print_shift_detailes($branch,$pay,$startat,$end_at)
{
  // return $request;
  $start_at= str_split($startat,10);
  $end_at= str_split($end_at,10);
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($branch=='-'&&$pay=='-'){
$Invoices=invoices::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
    
return view('reports.print_shift_detailes',compact('Invoices')) ;
     
    }
    if($branch=='-'&&$pay=='-'){
        $Invoices=invoices::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
        //return $Invoices;       
        return view('reports.print_shift_detailes',compact('Invoices'))  ;
             
            }
            elseif($branch!='-'&&$pay=='-'){
                $Invoices=invoices::where('branchs_id',$branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
                //return $Invoices;
                    
                return view('reports.print_shift_detailes',compact('Invoices'))->with('pay',[$pay,$branch])  ;
                     
         }
         elseif($branch=='-'&&$pay!='-'){
            $Invoices=invoices::where('Pay',$pay)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
            //return $Invoices;
                
            return view('reports.print_shift_detailes',compact('Invoices'))->with('pay',[$pay,$branch])   ;
                 
     }
         else{
                        $Invoices=invoices::where('branchs_id',$branch)->where('Pay',$pay)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
                        //return $Invoices;
                           return view('reports.print_shift_detailes',compact('Invoices'))  ;
                    }

}











public function printReportemployeeSales($usertId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    $Invoices= invoices::where('user_id',$usertId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();



  //  return $usertId;
       return view('reports.print_report_employee_sales',compact('Invoices'))  ;
    
}
public function print_credit_collection($userId,$startat,$end_at){
    
    // return $request;
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
      app()->setLocale(LaravelLocalization::getCurrentLocale());
      $UserId=$userId;
      if($UserId=='-'){
  $Invoices=credittransactions::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
  //return $Invoices;

  return view('reports.print_credit_collection',compact('Invoices')) ;
       
      }
      $Invoices=credittransactions::where('customer_id',$UserId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
  return $Invoices;
     return view('reports.print_credit_collection',compact('Invoices'))  ;
  }
public function  print_purchasereports($productId,$startat,$end_at){



    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $supplierId=$productId;
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    if($supplierId=='-'){
$products=orderDetails::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
    
return view('reports.print_purchasereports',compact('products'));
     
    }
    $products=orderDetails::where('product_id',$productId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
   return view('reports.print_purchasereports',compact('products'))  ;

}






public function print_Purchasesـfromـsuppliers($branch,$pay,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);

    if($pay=='-'&&$branch=='-'){
        $Invoices=resource_purchases::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        //return $Invoices;
            
            }
            elseif($pay!='-'&&$branch=='-'){
                $Invoices=resource_purchases::where('Pay_Method_Name',$pay)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }
            elseif($pay=='-'&&$branch!='-'){
                $Invoices=resource_purchases::where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }else{
                $Invoices=resource_purchases::where('Pay_Method_Name',$pay)->where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }



           return view('reports.print_Purchasesـfromـsuppliers',compact('Invoices'))->with('pay',$pay)  ;
    
}



public function print_Refundـofـresourceـpurchases($branch_id,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    if($branch_id!='-'){
        $Invoices=resource_purchases::where('branchs_id',$branch_id)->where('recoveredـpieces','!=',0)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

        return view('reports.print_Refundـofـresourceـpurchases',compact('Invoices'))  ;
   
    }
    $Invoices=resource_purchases::where('recoveredـpieces','!=',0)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

           return view('reports.print_Refundـofـresourceـpurchases',compact('Invoices'))  ;
    
}


public function printReportoffer_price_customer($userId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    if($userId=='-'){
        $Invoices=offer_price_to_customer::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=',   $end_at)->get();
                return view('reports.printReportoffer_price_customer',compact('Invoices'))  ;
             
            }
            $Invoices=offer_price_to_customer::where('customer_id',$userId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=',   $end_at)->get();
        


   // return $Invoices;
       return view('reports.printReportoffer_price_customer',compact('Invoices')) ;
    
}


public function print_Requestـaـquoteـfromـtheـsupplier($branch,$supplierId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    $supplierId=$supplierId;




    if($supplierId=='-'&&$branch=='-'){
        $Invoices=order_price_from_supplier::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        //return $Invoices;
            
            }
            elseif($supplierId!='-'&&$branch=='-'){
                $Invoices=order_price_from_supplier::where('suplier_id',$supplierId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }
            elseif($supplierId=='-'&&$branch!='-'){
                $Invoices=order_price_from_supplier::where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }else{
                $Invoices=order_price_from_supplier::where('branchs_id',$branch)->where('suplier_id',$supplierId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
            }






   return view('reports.print_Requestـaـquoteـfromـtheـsupplier',compact('Invoices'))
     ;
}







public function printDelivery_notes($orderId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    $supplierId=$orderId;
    if($supplierId=='-'){
$Invoices=resource_purchases::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
    
return view('reports.print_Report_delivery_notes',compact('Invoices'))   ;
     
    }
    $Invoices=resource_purchases::where('orderId',$supplierId)->whereDate('created_at', '>=',$startat) ->whereDate('created_at', '<=', $end_at)->get();
//return $Invoices;
   return view('reports.print_Report_delivery_notes',compact('Invoices')) ;

    
}

public function print_report_order_from_supplier($supplierId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    if($supplierId=='-'){
        $Invoices=orderTosupllier::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=',   $end_at)->get();
                return view('reports.print_report_order_from_supplier',compact('Invoices'))  ;
             
            }
            $Invoices=orderTosupllier::where('suplier_id',$supplierId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=',   $end_at)->get();
        


   // return $Invoices;
       return view('reports.print_report_order_from_supplier',compact('Invoices')) ;
    
}



public function printReportProfitSales($branch,$UserId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);

if($UserId=='-'&&$branch=='-'){

    $Invoices= invoices::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();



}
elseif($UserId!='-'&&$branch=='-'){

    $Invoices= invoices::where('customer_id',$UserId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();



}


elseif($UserId=='-'&&$branch!='-'){

    $Invoices= invoices::where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();



}
else{
    $Invoices= invoices::where('customer_id',$UserId)->where('branchs_id',$branch)->where('customer_id',$UserId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

}


   // return $Invoices;
       return view('reports.printReportProfitSales',compact('Invoices')) ;
    
}



public function printReportProductSales($branch,$productId,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);




    
        if($branch=='-')
        {
            $products=sales::where('product_id',$productId)->where('quantity','!=',0)->whereDate('created_at', '>=',  $startat) ->whereDate('created_at', '<=', $end_at)->get();
    
        }
  
    else{
        $products=sales::where('product_id',$productId)->where('branch_id',$branch)->where('quantity','!=',0)->whereDate('created_at', '>=',  $startat) ->whereDate('created_at', '<=', $end_at)->get();
      
    }
    

    //return $products;
       return view('reports.printReportProductSales',compact('products')) ;
    
}

public function print_customerـpurchases($branch,$customerId,$startat,$end_at){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    $Invoices=[];
    $typeinvoise='';
    $salesreport='no';
    if($customerId=='-'&&$branch=="-"){
      
        $Invoices= invoices::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

    }
    else{

        if($customerId=="-"&&$branch!="-"){
            $Invoices= invoices::where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
        }
        elseif($customerId!="-"&&$branch=="-"){
            $Invoices= invoices::where('customer_id',$customerId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
        }
        else{
            $Invoices= invoices::where('branchs_id',$branch)->where('customer_id',$customerId)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

        }




        $typeinvoise=__('report.customerـpurchases');

    }
   
  
    $data=[
'invoices'=> $Invoices,
'typeinvoise'=>$typeinvoise,
'salesreport'=>'no'
    ];
  //  return $data;
return view('reports.printReportInvoices',compact('data'));
}






public function printInvoicesReport($branch,$pay,$startat,$end_at)
{
    //return $request
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    $Invoices=[];
    $typeinvoise='';
    $salesreport='no';
    if($pay=='-'&&$branch=="-"){
      
        $Invoices= invoices::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        $salesreport='yes';
        $typeinvoise='Seles report';
    }
    else{

        if($pay=="-"&&$branch!="-"){
            $Invoices= invoices::where('branchs_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
        }
        elseif($pay!="-"&&$branch=="-"){
            $Invoices= invoices::where('Pay',$pay)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
        
        }
        else{
            $Invoices= invoices::where('branchs_id',$branch)->where('Pay',$pay)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();

        }




        $typeinvoise=$pay;

    }
   
  
    $data=[
'invoices'=> $Invoices,
'typeinvoise'=>$typeinvoise,
'salesreport'=> $salesreport
    ];
  //  return $data;
return view('reports.printReportInvoices',compact('data'));
}
public function salesReport(){
    return  view('reports.sales_report')  ;

}

public function salesReportsearch(Request $request)
{
  //  return $request;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
if($request->pay=="-"&&$request->branch=="-"){
    $Invoices= invoices::whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
elseif($request->pay=="-"&&$request->branch!="-"){
    $Invoices= invoices::where('branchs_id',$request->branch)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
elseif($request->pay!="-"&&$request->branch=="-"){
    $Invoices= invoices::where('Pay',$request->pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}
else{
    $Invoices= invoices::where('branchs_id',$request->branch)->where('Pay',$request->pay)->whereDate('created_at', '>=', $request->start_at) ->whereDate('created_at', '<=', $request->end_at)->get();

}


return view('reports.sales_report',compact('Invoices'))->with('pay',[$request->pay,$request->branch])  ;
}

public function print_return_Report($branch,$startat,$end_at)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $startat= str_split($startat,10);
    $end_at= str_split($end_at,10);
    if($branch=='-'){
        $Invoices= return_sales::whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
    
    }
    else{
        $Invoices= return_sales::where('branch_id',$branch)->whereDate('created_at', '>=', $startat) ->whereDate('created_at', '<=', $end_at)->get();
    
    }
    

    

//return  $Invoices;
return view('reports.print_report_sales_returen',compact('Invoices'))  ;  
}


public function printstockquantity( $branch){
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($branch=='-'){
        $products= products::get();
    
    }else{
        $products= products::where('branchs_id',$branch)->get();
    
    }
    return view('reports.printstockquantity',compact('products')) ;
}




public function printBest_selling_products( $branch)
{
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($branch=='-'){
      $bestSaleing=products::orderBy('numberـofـsales', 'desc')->get();

    }
    else{
      $bestSaleing=products::where('branchs_id',$branch)->orderBy('numberـofـsales', 'desc')->get();

    }

return view('reports.printBest_selling_products',compact('bestSaleing')) ;
}





public function print_VAT ($branch,$start_at,$end_at) {
    app()->setLocale(LaravelLocalization::getCurrentLocale());
//return $request;
$totalVatSales=0;
$totalVatPrachese=0;
if($branch=='-'){
    $invoices=invoices::whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();

foreach($invoices as $invoice){
    $totalVatSales+=$invoice->Added_Value;
}
$resource_purchases=resource_purchases::
whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
foreach($resource_purchases as $resource_purchase){
    $ordersDetails=orderDetails::where('order_owner',$resource_purchase->orderId)->get();
    foreach($ordersDetails as $orderDetailes){
        $totalVatPrachese+=$orderDetailes->Added_Value*$orderDetailes->numberofpice;
    }
}
}
else{
    $invoices=invoices::where('branchs_id',$branch)->whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();

    foreach($invoices as $invoice){
        $totalVatSales+=$invoice->Added_Value;
    }
    $resource_purchases=resource_purchases::where('branchs_id',$branch)->
    whereDate('created_at', '>=', $start_at) ->whereDate('created_at', '<=', $end_at)->get();
    foreach($resource_purchases as $resource_purchase){
        $ordersDetails=orderDetails::where('order_owner',$resource_purchase->orderId)->get();
        foreach($ordersDetails as $orderDetailes){
            $totalVatPrachese+=$orderDetailes->Added_Value*$orderDetailes->numberofpice;
        }
    }  
}

$data=[
    'start_at'=>$start_at,
    'end_at'=> $end_at,
    'totalVatSales'=>  $totalVatSales ,
    'totalVatPrachese'=> $totalVatPrachese 
];

return view('reports.print_VAT',compact('data'))  ;
}





}

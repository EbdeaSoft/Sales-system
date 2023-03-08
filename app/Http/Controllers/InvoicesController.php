<?php

namespace App\Http\Controllers;
use App\Models\return_sales;
use App\Models\invoices;
use App\Models\sales;
use Illuminate\Http\Request;
use App\Models\Avt;

use App\Models\products;
use App\Models\customers;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=[];
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('products.salesـreturned',compact('data'));
 
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
       // return Auth()->User()->branch->id;
        app()->setLocale(LaravelLocalization::getCurrentLocale());
        $avtSaleRate=Avt::find(1);
 //return $avtSaleRate->AVT;
        $updateProduct=products::find($request->productNo);
       // return $updateProduct;
        if($updateProduct->numberofpice>=1)
        {
        products::where('id',$request->productNo)->Update([
            'numberofpice'=>$updateProduct->numberofpice-$request->quantity,
            'numberـofـsales'=>$updateProduct->numberـofـsales+$request->quantity
        ]);
        $invoiceNumber=$request->invoice_number;
        if($request->invoice_number==null){
            $Invoice=invoices::create(
                [
    'customer_id'=>$request->clientnamesearch?? 1,
    'user_id'=>Auth()->user()->id,
    'Price'=>($request->product_price-$request->product_price_after_dis)*$request->quantity,
    'Added_Value'=>(($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT
)*$request->quantity,
    'Pay'=>$request->pay,
    'branchs_id'=>Auth()->User()->branch->id ,
    'Number_of_Quantity'=>$request->quantity,
    'created_at'=>\Carbon\Carbon::now()->addHours(3),
    'updated_at'=>\Carbon\Carbon::now()->addHours(3),
                ]
                );
                $invoiceNumber=$Invoice->id;
        }
        else{
            $InvoiceData=invoices::find(  $invoiceNumber);
            $Invoice=invoices::where('id',  $invoiceNumber)->Update(
                [
   
    'Price'=>$InvoiceData->Price+(($request->product_price-$request->product_price_after_dis)*$request->quantity),
    'Added_Value'=>$InvoiceData->Added_Value+((($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT)*$request->quantity),
    'Number_of_Quantity'=>$InvoiceData->Number_of_Quantity+$request->quantity,
    'updated_at'=>\Carbon\Carbon::now()->addHours(3),
                ]
                );
        }


$productSales=sales::create(
    [
        'product_id'=>$request->productNo,
        'invoice_id'=>$invoiceNumber,
        'branch_id'=>Auth()->User()->branch->id ,
        'Discount_Value'=>$request->product_price_after_dis,
        'Added_Value'=>($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT
        ,
        'Unit_Price'=>$request->product_price - $request->product_price_after_dis,
        'quantity'=>$request->quantity,
        'created_at'=>\Carbon\Carbon::now()->addHours(3),
    ]
    );

}
else{
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'عدم وجود مخزون من هذه المنتج':'Out of stock of this product'
    ;

    session()->flash('delete',  $message);
    $data=[
        "invoice_id"=>null
            ];
        
        return view('products.sales',compact('data'));
          
}

if($request->pay=="Credit"){
$customerdata=customers::find($request->clientnamesearch);

$updateCustomer=customers::where('id',$request->clientnamesearch)->update(
    [
'Balance'=>$customerdata->Balance+(($request->product_price*$request->quantity)+($request->quantity*$request->product_price*$avtSaleRate->AVT
))
    ]
);
 

}
$product=sales::where('invoice_id',$invoiceNumber)->get();
//return $product;
$customer=customers::find($request->clientnamesearch);

    $data=[
'pay'=>$request->pay ,
'customer'=>$customer,
'product'=>$product,
"invoice_id"=>$invoiceNumber
    ];
//return $data;
return view('products.sales',compact('data'));
       
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function printInvoice( $invoicesid)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $saleData= sales::where("invoice_id",$invoicesid)->get();
        $InvoiceData=invoices::find($invoicesid);
        $data=[
            'salesData'=>$saleData ,
            'invoiceData'=>  $InvoiceData,
        ];
      //  return $InvoiceData;
return  view('products.printInvoicesToClient',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
       // return  $request;
       $avtSaleRate=Avt::find(1);

       app()->setLocale(LaravelLocalization::getCurrentLocale());

       $saleData= sales::find($request->id);
        $productSales=sales::where('id',$request->id)->update(
            [
                'quantity'=>$saleData->quantity-$request->return_quentity,
                'updated_at'=>\Carbon\Carbon::now()->addHours(3),
            ]
            );
        $InvoiceData=invoices::find($saleData->invoice_id);

        $Invoice=invoices::where('id',  $saleData->invoice_id)->Update(
            [

'Price'=>$InvoiceData->Price- ($saleData->Unit_Price*$request->return_quentity),
'Added_Value'=>$InvoiceData->Added_Value-($saleData->Unit_Price*$request->return_quentity*$avtSaleRate->AVT
),
'Number_of_Quantity'=>$InvoiceData->Number_of_Quantity-$request->return_quentity,
'updated_at'=>\Carbon\Carbon::now()->addHours(3),
            ]
            );


            $InvoiceData=invoices::find($saleData->invoice_id);
            if($InvoiceData->Pay=="Credit"){
             $customerdata=customers::find($InvoiceData->customer_id);
            // return ($customerdata->Balance-(($request->return_quentity*$saleData->Unit_Price)+($request->return_quentity*$saleData->Added_Value)));
             $updateCustomer=customers::where('id',$InvoiceData->customer_id)->update(
                 [
             'Balance'=>$customerdata->Balance-(($request->return_quentity*$saleData->Unit_Price)+($request->return_quentity*$saleData->Added_Value)),
             'updated_at'=>\Carbon\Carbon::now()->addHours(3),

                 ]
             );
              
             }

            $product=sales::where('invoice_id',$saleData->invoice_id)->get();
            //return $product;
                $data=[
            'product'=>$product,
            "invoice_id"=>$saleData->invoice_id
                ];
            return view('products.sales',compact('data'));  
                    
    }
    public function printReceiptToStorehouse( $invoicesid)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $saleData= sales::where("invoice_id",$invoicesid)->get();
        $InvoiceData=invoices::find($invoicesid);
        $data=[
            'salesData'=>$saleData ,
            'invoiceData'=>  $InvoiceData,
        ];
       // return $InvoiceData->customer->name;
return  view('products.printReceiptToStorehouse',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    
    public function return_sale(Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $product=sales::where('invoice_id',$request->invoice_no)->get();
        if(count($product)==0)
        {
            $message=LaravelLocalization::getCurrentLocale()=='ar'?'  لم يتم العثور علي فاتورة بهذة الرقم':'No invoice with this number was found';

            session()->flash('notfountreturnproduct',$message);
           $data=[];
           return view('products.salesـreturned',compact('data'));
    
           }
       else {
            $data=[
                'product'=>$product,
                "invoice_id"=>$request->invoice_no
                    ];
                    session()->flash('foundinvoice','   تم العثور علي فاتورة ');

                    return view('products.salesـreturned',compact('data'));
                }
       
    }


    public function update(Request $request)
    {
        //
      //  return $request;
        app()->setLocale(LaravelLocalization::getCurrentLocale());
        $avtSaleRate=Avt::find(1);

       $saleData= sales::find($request->id);
       //return $saleData;
       $updateProduct=products::find($saleData->product_id);

       products::where('id',$saleData->product_id)->Update([
           'numberofpice'=>$updateProduct->numberofpice+$request->return_quentity,
           'numberـofـsales'=>$updateProduct->numberـofـsales-$request->return_quentity
       ]);
       $productSales=sales::where('id',$request->id)->update(
           [
               'quantity'=>$saleData->quantity-$request->return_quentity,
               'updated_at'=>\Carbon\Carbon::now()->addHours(3),
           ]
           );

       $InvoiceData=invoices::find($saleData->invoice_id);
       if($InvoiceData->Pay=="Credit"){
        $customerdata=customers::find($InvoiceData->customer_id);
       // return ($customerdata->Balance-(($request->return_quentity*$saleData->Unit_Price)+($request->return_quentity*$saleData->Added_Value)));
        $updateCustomer=customers::where('id',$InvoiceData->customer_id)->update(
            [
        'Balance'=>$customerdata->Balance-(($request->return_quentity*$saleData->Unit_Price)+($request->return_quentity*$saleData->Added_Value)),
        'updated_at'=>\Carbon\Carbon::now()->addHours(3),

            ]
        );
         
        }
    $return_sales= return_sales::create([
        'product_id'=>$saleData->product_id ,
        'invoice_id'=>$saleData->invoice_id,
        'branch_id'=>Auth()->User()->branch->id ,

        'return_Added_Value'=>$saleData->Added_Value,
         'return_Unit_Price'=>$saleData->Unit_Price,
         'return_quantity'=>$request->return_quentity,
          'created_at'=>\Carbon\Carbon::now()->addHours(3),

        ]);
        //return  $return_sales;
       $Invoice=invoices::where('id',  $saleData->invoice_id)->Update(
           [

'Price'=>$InvoiceData->Price- ($saleData->Unit_Price*$request->return_quentity),
'Added_Value'=>$InvoiceData->Added_Value-($saleData->Unit_Price*$avtSaleRate->AVT*$request->return_quentity),
'Number_of_Quantity'=>$InvoiceData->Number_of_Quantity-$request->return_quentity,
'updated_at'=>\Carbon\Carbon::now()->addHours(3),
           ]
           );
           $product=sales::where('invoice_id',$saleData->invoice_id)->get();
           //return $product;
               $data=[
           'product'=>$product,
           "invoice_id"=>$saleData->invoice_id
               ];
           return view('products.salesـreturned',compact('data'));  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function Receipt(Request $request)
    {
        //
        $avtSaleRate=Avt::find(1);

        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $updateProduct=products::find($request->productNo);
        // return $updateProduct;
         if($updateProduct->numberofpice>=1){
         products::where('id',$request->productNo)->Update([
             'numberofpice'=>$updateProduct->numberofpice-$request->quantity,
         ]);
         $invoiceNumber=$request->invoice_number;
         if($request->invoice_number==null){
             $Invoice=invoices::create(
                 [
     'customer_id'=>$request->clientnamesearch??1,
     'user_id'=>Auth()->user()->id,
     'Price'=>$request->product_price-$request->product_price_after_dis,
     'Added_Value'=>($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT
     ,
     'Pay'=>$request->pay,
     'Number_of_Quantity'=>$request->quantity,
     'created_at'=>\Carbon\Carbon::now()->addHours(3),
     'updated_at'=>\Carbon\Carbon::now()->addHours(3),
                 ]
                 );
                 $invoiceNumber=$Invoice->id;
         }
         else{
             $InvoiceData=invoices::find(  $invoiceNumber);
             $Invoice=invoices::where('id',  $invoiceNumber)->Update(
                 [
    
     'Price'=>$InvoiceData->Price+($request->product_price-$request->product_price_after_dis),
     'Added_Value'=>$InvoiceData->Added_Value+(($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT
    ),
     'Number_of_Quantity'=>$InvoiceData->Number_of_Quantity+$request->quantity,
     'updated_at'=>\Carbon\Carbon::now()->addHours(3),
                 ]
                 );
         }
 $productSales=sales::create(
     [
         'product_id'=>$request->productNo,
         'invoice_id'=>$invoiceNumber,
         'Discount_Value'=>$request->product_price_after_dis,
         'Added_Value'=>($request->product_price-$request->product_price_after_dis)*$avtSaleRate->AVT
         ,
         'Unit_Price'=>$request->product_price-$request->product_price_after_dis,
         'quantity'=>$request->quantity,
         'branch_id'=>Auth()->User()->branch->id ,

         'created_at'=>\Carbon\Carbon::now()->addHours(3),
     ]
     );
 }
 else{
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'عدم وجود مخزون من هذه المنتج':'No stock of this product';

     session()->flash('delete', $message);
     $data=[
         "invoice_id"=>null
             ];
         
         return view('products.Receipt',compact('data'));
           
 }
 $product=sales::where('invoice_id',$invoiceNumber)->get();
 //return $product;
     $data=[
 'product'=>$product,
 "invoice_id"=>$invoiceNumber
     ];
 
 return view('products.Receipt',compact('data'));
        
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\products;
use App\Models\supllier;

use App\Models\resource_purchases;
use App\Models\customers;
use App\Models\User;
use App\Models\Avt;
use App\Models\order_price_from_supplier;
use App\Models\order_price_from_supplier_items;
use Illuminate\Http\Request;
use App\Models\orderDetails;
use App\Models\orderTosupllier;
use Carbon\Carbon;
use App\Models\offer_price_to_customer_items;
use App\Models\offer_price_to_customer;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

class ProductsController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $allcustomers=customers::get();
        $allproduct=products::where('branchs_id',Auth()->User()->branchs_id)->get();
$data=[
    "allcustomers"=>  $allcustomers,
    "allproduct"=> $allproduct
];
//return $data;
        return  view('products.transactions',compact('data'));
    }




    public function showAllProducts()
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

//return $data;
        return  view('showAllProducts');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    



    public function AddproductPriceToCustomer(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

       //  return $request;
         $customertid=$request->clientnamesearch=="-"?$request->clientNosearch:$request->clientnamesearch;
         $productid=$request->productNo=="-"?$request->productname:$request->productNo;
         if($request->orderNo==null){
             $create_order= offer_price_to_customer::create(
                 [
             'customer_id'=> $customertid ,
             'branchs_id'=> Auth()->User()->branchs_id    ,
             'created_at'=>\Carbon\Carbon::now()->addHours(3),
             'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,
     
                 ]
                 );
                 $create_order_price_from_supplier_items=offer_price_to_customer_items::create(
                     [
                         'product_id'=>$productid  ,
                         'quantity'=> $request->quentity ,
                         'order_id'=>$create_order->id,
                         'created_at'=> \Carbon\Carbon::now()->addHours(3) ,
                         'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,
     
                   
                     ]
                     );

                   $itemsRequest=  offer_price_to_customer_items::where('order_id',$create_order->id)->get();
                 
                 return view('products.Offerـpricesـtoـcustomer',compact('itemsRequest'))->with('supplierdata',$request);
                 
             }
     else{
      //  return 'agin';

         $create_order_price_from_supplier_items=offer_price_to_customer_items::create(
             [
                 'product_id'=>$productid  ,
                 'quantity'=> $request->quentity ,
                 'order_id'=>$request->orderNo,
                 'created_at'=> \Carbon\Carbon::now()->addHours(3) ,
                 'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,
           
             ]
             );
         
         
             $itemsRequest=  offer_price_to_customer_items::where('order_id',$request->orderNo)->get();

         return view('products.Offerـpricesـtoـcustomer',compact('itemsRequest'))->with('supplierdata',$request);
         
     }
     }



public function order_price_from_suppliers(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

   // return $request;
    $suppliertid=$request->suppliertNosearch=="-"?$request->suppliernamesearch:$request->suppliertNosearch;
    $productid=$request->productNo=="-"?$request->productname:$request->productNo;
    if($request->orderNo==null){
        $create_order= order_price_from_supplier::create(
            [
        'suplier_id'=> $suppliertid ,
        'branchs_id'=>  Auth()->User()->branchs_id ,
        'created_at'=>\Carbon\Carbon::now()->addHours(3),
        'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,

            ]
            );
            $create_order_price_from_supplier_items=order_price_from_supplier_items::create(
                [
                    'product_id'=>$productid  ,
                    'quantity'=> $request->quentity ,
                    'order_id'=>$create_order->id,
                    'created_at'=> \Carbon\Carbon::now()->addHours(3) ,
                    'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,

              
                ]
                );
              $itemsRequest=  order_price_from_supplier_items::where('order_id',$create_order->id)->get();
            
            
            return view('products.Requestـpricesـofـproducts_from_supplier',compact('itemsRequest'))->with('supplierdata',$request);
            
        }
else{
    $create_order_price_from_supplier_items=order_price_from_supplier_items::create(
        [
            'product_id'=>$productid  ,
            'quantity'=> $request->quentity ,
            'order_id'=>$request->orderNo,
            'created_at'=> \Carbon\Carbon::now()->addHours(3) ,
            'updated_at'=>\Carbon\Carbon::now()->addHours(3) ,
      
        ]
        );
    
    
        $itemsRequest=  order_price_from_supplier_items::where('order_id',$request->orderNo)->get();

    return view('products.Requestـpricesـofـproducts_from_supplier',compact('itemsRequest'))->with('supplierdata',$request);
    
}
}


public function print_order_perice_to_customer($product_id){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

     
    $itemsRequest=  offer_price_to_customer_items::where('order_id',$product_id)->get();

    return view('products.print_order_perice_to_customer',compact('itemsRequest'));
     
}
public function printOrderPriceFromSupplier($product_id){
     
    $itemsRequest=  order_price_from_supplier_items::where('order_id',$product_id)->get();

    return view('products.print_order_perice_from_supplier',compact('itemsRequest'));
     
}


public function purchases(){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $allcustomers=supllier::get();

    $allproduct=products::where('branchs_id',Auth()->User()->branchs_id)->get();
$data=[
    'pay'=>null,
"allcustomers"=>  $allcustomers,
"allproduct"=> $allproduct
];
//return $data;
    return  view('products.purchases',compact('data'));

    
}


public function Purchase_returns(){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $data=[];
    return  view('products.purchase_return',compact('data'));

$orderTosupllier=orderTosupllier::get();
//purchase_return
}







public function Purchase_returns_Data(Request $request){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

 $orderOwner=orderTosupllier::find($request->clientName);
 $orderdetails=orderDetails::where('order_owner',$request->clientName)->get();
 if($orderOwner==null)
 {
     $message=LaravelLocalization::getCurrentLocale()=='ar'?'  لم يتم العثور علي فاتورة بهذة الرقم':'No invoice with this number was found';

     session()->flash('notfountreturnpuracheseproduct',$message);
    $data=[];
    return view('products.purchase_return',compact('data'));

    }
 $user=User::find($orderOwner->user_id);
 $branch=$user->branch->name;

 $data=[
    'branch'=>$branch,
    'supllier'=>$orderOwner
    ,
    'product'=>$orderdetails
 ];
 //return $data;
 return    view('products.purchase_return',compact('data'));

}

    public function create( Request $request)
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //
        $t=time();

        $clientphone   = $request["phonenumber"];;  
        $clientname= $request["clientName"];  
        $clientaddress= $request["address"];  
        $clientnote= $request["notes"];  
        $product=products::get();
        $data=[
            "date"=>date("Y-m-d",$t),
            'product'=>$product  ,
            'clientnote'=>$clientnote,
            'clientphone'=> $clientphone ,
            'clientname'=>$clientname,
            'clientaddress'=>$clientaddress,
            'print'=>'print quentity'

        ];
        return view('products.print_products',compact('data'));

         

    }

 

public function getProductsPriceFromSupplier(){
    app()->setLocale(LaravelLocalization::getCurrentLocale());

    $allproduct=products::where('branchs_id',Auth()->User()->branchs_id)->get();
$data=[
];
//return $data;
    return  view('products.Requestـpricesـofـproducts_from_supplier',compact('data'))->with('order_id',"-");

}

    public function showProductsPrice( Request $request)
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //
         //
         $allcustomers=customers::get();
         $allproduct=products::get();
 $data=[
     "allcustomers"=>  $allcustomers,
     "allproduct"=> $allproduct
 ];
 //return $data;
 $itemsRequest=[]
;
         return  view('products.Offerـpricesـtoـcustomer',compact('itemsRequest'))->with('order_id','-');

         

    }
    
    public function print_all_products_price( Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $t=time();

        
        $product=products::get();
        $data=[
            "date"=>date("Y-m-d",$t),
            'product'=>$product  ,
                 ];
        return view('products.print_all_products_price',compact('data'));

        }
        public function printProductPriceToCustomer(  $request)
        {
            //
            app()->setLocale(LaravelLocalization::getCurrentLocale());
    
            $t=time();
    
            $clientphone   = $request["phonenumber"];;  
            $clientname= $request["clientName"];  
            $clientaddress= $request["address"];  
            $clientnote= $request["notes"];  
            $product=products::get();
            $data=[
                "date"=>date("Y-m-d",$t),
                'product'=>$product  ,
                'clientnote'=>$clientnote,
                'clientphone'=> $clientphone ,
                'clientname'=>$clientname,
                'clientaddress'=>$clientaddress,
                'print'=>'printprice'
            ];
            return view('products.print_products',compact('data'));
    
            }

    public function printProductPrice( Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $t=time();

        $clientphone   = $request["phonenumber"];;  
        $clientname= $request["clientName"];  
        $clientaddress= $request["address"];  
        $clientnote= $request["notes"];  
        $product=products::get();
        $data=[
            "date"=>date("Y-m-d",$t),
            'product'=>$product  ,
            'clientnote'=>$clientnote,
            'clientphone'=> $clientphone ,
            'clientname'=>$clientname,
            'clientaddress'=>$clientaddress,
            'print'=>'printprice'
        ];
        return view('products.print_products',compact('data'));

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
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show( $products)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $product=products::find($products);
         return  $product;
    }


public function Addproducttopurchases(Request $request){
 // return $request;
 $avtPurcheseRate=Avt::find(2);
   app()->setLocale(LaravelLocalization::getCurrentLocale());
    if($request->orderNo==null){ 
           $clientNo=0;
        if($request->clientNosearch=="ادخل رقم العميل"){
        $clientNo=$request->clientnamesearch;
       }
    else{
    
       $clientNo=$request->clientNosearch;
    
    }



        $createorder=orderTosupllier::create(
    [
    'user_id'=>Auth()->user()->id ,
    'suplier_id'=>$clientNo,
    'Limit_credit'=>$request->pay ,
    'purchaseـamount'=>$request->quentity*$request->quentityprice,
    'added_value'=>$request->quentity*$request->quentityprice*$avtPurcheseRate->AVT

    ]
    );

 
    resource_purchases::create(
        [
            'orderId'=>$createorder->id,
            'suplier_id'=>$clientNo,
            'In_debt'=>($request->quentity*$request->quentityprice)+($request->quentityprice*$avtPurcheseRate->AVT*$request->quentity),
            'Pay_Method_Name'=>$request->pay,
            'notes'=> $request->notes    ,
            'branchs_id'=> $request->branchs_id ,
            'created_at'  =>  \Carbon\Carbon::now()->addHours(3), 
            'updated_at'  =>  \Carbon\Carbon::now()->addHours(3), 
        ]
        );

        if($request->pay=='Credit'){
          $supllierIn_debt=  supllier::find($clientNo);
            supllier::where('id',$clientNo)->update(
                [
'In_debt'=>($request->quentity*$request->quentityprice)+($request->quentityprice* $avtPurcheseRate->AVT*$request->quentity)+ $supllierIn_debt->In_debt,
                ]
                );
        }
}
    else{
       
            $clientNo=0;
         if($request->clientNosearch=="ادخل رقم العميل"){
         $clientNo=$request->clientnamesearch;
        }
     else{
     $clientNo=$request->clientNosearch;
     
     }

        $getrecientorder=orderTosupllier::where('id',$request->orderNo)->first();
        $createorder=orderTosupllier::where('id',$request->orderNo)->update(
                    [
                          
                                  'Limit_credit'=>$request->pay ,
                                'purchaseـamount'=>$getrecientorder->purchaseـamount+($request->quentity*$request->quentityprice),
                               'added_value'=>$getrecientorder->added_value+($request->quentity*$request->quentityprice* $avtPurcheseRate->AVT)
                                                          
                                                                  ]
                                                                          );
   $resourceـpurchases= resource_purchases::where('orderId',$request->orderNo)->first();
   resource_purchases::where('orderId',$request->orderNo)->update(
    [
        'In_debt'=>$resourceـpurchases->In_debt+($request->quentity*$request->quentityprice)+($request->quentityprice* $avtPurcheseRate->AVT*$request->quentity)
    ]
    );
    if($request->pay=='Credit'){

    $supllierIn_debt=  supllier::find($clientNo);
    supllier::where('id',$clientNo)->update(
        [
            'In_debt'=>($request->quentity*$request->quentityprice)+($request->quentityprice* $avtPurcheseRate->AVT*$request->quentity)+ $supllierIn_debt->In_debt,
            ]
        );

    }
}

    $productno=0;
    if($request->productNo=="ادخل  رقم المنتج"){
        $productno=$request->productname;
    }
    else{
        $productno=$request->productNo;
    
    }
    $Added_value=$request->quentityprice* $avtPurcheseRate->AVT;
    $product_Price=$request->quentityprice;
         $orderdetails=orderDetails::create(
                [
                'product_id'=>$productno,
                'order_owner'=>$createorder->id??$request->orderNo,
                'product_name'=>$request->productnameshow,
                'purchasingـprice'=>$product_Price,
                'Added_Value'=>$Added_value,
                'numberofpice'=>$request->quentity,
                'created_at'=>date("Y-m-d"),
                'updated_at'=>date("Y-m-d"),
                ]
            );
            $updateProduct=products::find($productno);
            products::where('id',$productno)->Update([
                'purchasingـprice'=>$request->quentityprice,
                'sale_price'=>$request->sale_price,
                'numberofpice'=>$updateProduct->numberofpice+$request->quentity,
            ]);
         //   return $clientNo;
          
          $recentsupllier=supllier::find($clientNo);
          $supllier=supllier::get();
          $allproduct=products::get();
            $orderdetails=orderDetails::where('order_owner',$orderdetails->order_owner)->get();
        $data=[
            'pay'=> $request->pay    ,
       'recentsupllier'=>$recentsupllier,
        "allcustomers"=>  $supllier,
        "allproduct"=> $allproduct,
        "product"=>$orderdetails
        ];
      //  return $data;
            return  view('products.purchases',compact('data'));
        }




    public function AddproducttoSupllier(Request $request){

if($request->orderNo==null){ 
       $clientNo=0;
    if($request->clientNosearch=="ادخل رقم العميل"){
    $clientNo=$request->clientnamesearch;
   }
else{
$clientNo=$request->clientNosearch;

}
    $createorder=orderTosupllier::create(
[
'user_id'=>Auth()->user()->id   ,
'suplier_id'=>$clientNo,
// 'Limit_credit'=>$request->pay ,
// 'purchaseـamount'=>$request->quentity*$request->quentityprice,
// 'added_value'=>$request->quentityprice*0.15

]
);
}
// else{
//         $getrecientorder=orderTosupllier::where('id',$request->orderNo)->first();
//             $createorder=orderTosupllier::where('id',$request->orderNo)->update(
//                     [
                          
//                                   'Limit_credit'=>$request->pay ,
//                                           'purchaseـamount'=>$getrecientorder->purchaseـamount+($request->quentity*$request->quentityprice),
//                                                   'added_value'=>$getrecientorder->purchaseـamount+($request->quentityprice*0.15)
                                                          
//                                                                   ]
//                                                                           );
// }

$productno=0;
if($request->productNo=="ادخل  رقم المنتج"){
    $productno=$request->productname;
}
else{
    $productno=$request->productNo;
 
}
$avtPurcheseRate=Avt::find(2);
$Added_value=$request->quentityprice*$avtPurcheseRate->AVT;
$product_Price=$request->quentityprice-$Added_value;
     $orderdetails=orderDetails::create(
            [
            'product_id'=>$productno,
            'order_owner'=>$createorder->id??$request->orderNo,
            'product_name'=>$request->productnameshow,
            'purchasingـprice'=>$product_Price,
            'Added_Value'=>$Added_value,
            'numberofpice'=>$request->quentity,
            'created_at'=>date("Y-m-d"),
            'updated_at'=>date("Y-m-d"),
            ]
        );
      //  return $orderdetails;
        $supllier=supllier::get();
        $allproduct=products::get();
        $orderdetails=orderDetails::where('order_owner',$orderdetails->order_owner)->get();
    $data=[
    "allcustomers"=>  $supllier,
    "allproduct"=> $allproduct,
    "product"=>$orderdetails
    ];
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    return  view('products.Purchase_order_of_resources',compact('data'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function goToSale()
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //
        $data=[];
        return view('products.sales',compact(('data')));
    }

    public function goToReceipt()
    {
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //
        return view('products.Receipt');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

     $orderDetails=   orderDetails::where('product_name',$request->product_name)
        ->where('order_owner',$request->ordernumber)->first();
     $resource_purchases=   resource_purchases::where('orderId',$request->ordernumber)->first();
     if($resource_purchases->Pay_Method_Name=='Credit'){
        resource_purchases::where('orderId',$request->ordernumber)->update(
            [
'recoveredـpieces'=>$resource_purchases->recoveredـpieces+$request->return_quentity,
'In_debt'=>$resource_purchases->In_debt-(($orderDetails->purchasingـprice*$request->return_quentity)+($orderDetails->Added_Value*$request->return_quentity))
            ]
            );
            $supplier=supllier::find($resource_purchases->suplier_id);
          supllier::where('id',$resource_purchases->suplier_id)->update(
    [
'In_debt'=>$supplier->In_debt-(($orderDetails->purchasingـprice*$request->return_quentity)+($orderDetails->Added_Value*$request->return_quentity))
    ]
    );
     }else{
        resource_purchases::where('orderId',$request->ordernumber)->update(
            [
'recoveredـpieces'=>$resource_purchases->recoveredـpieces+$request->return_quentity,
'In_debt'=>$resource_purchases->In_debt-(($orderDetails->purchasingـprice*$request->return_quentity)+($orderDetails->Added_Value*$request->return_quentity))
           
]
            );  

     }
     
        $productData= products::find($request->id);
        products::where('id',$request->id)->Update([
            'numberofpice'=>$productData->numberofpice-$request->return_quentity,
        ]);
        orderDetails::where('product_name',$request->product_name)
        ->where('order_owner',$request->ordernumber)->update(
            [
'returns_purchase'=>$orderDetails->returns_purchase+$request->return_quentity,
'numberofpice'=>$orderDetails->numberofpice-$request->return_quentity
            ]
            );
            $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم تعديل  بنجاج':'has been modified successfully';

        session()->flash('editpurchase',$message);
        $data=[];
        return  view('products.purchase_return',compact('data'));    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $orderDetails=   orderDetails::where('product_name',$request->product_name)
        ->where('order_owner',$request->ordernumber)->first();
        $productData= products::find($request->id);
        products::where('id',$request->id)->Update([
            'numberofpice'=>$productData->numberofpice-$request->description,
        ]);
        $result= $orderDetails->numberofpice-$request->description;
        orderDetails::where('product_name',$request->product_name)
        ->where('order_owner',$request->ordernumber)->update(
            [
'returns_purchase'=>$request->description,
'numberofpice'=>$result
            ]
            );
            $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم حذف  بنجاح':'has been deleted successfully';

        session()->flash('delete', $message);
        return redirect('/Purchase_returns');
    }


    public function getProductdJsonDecode($id){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $product=   products::find($id);

        return   json_encode($product);
    }
}

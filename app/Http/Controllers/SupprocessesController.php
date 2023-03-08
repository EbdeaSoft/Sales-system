<?php

namespace App\Http\Controllers;


use App\Models\products;
use App\Models\supllier;
use App\Models\customers;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;


class SupprocessesController extends Controller
{
    //
    public function index(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('supProcesses.addProduct');
    } 


    public function product_movement(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('supProcesses.product_movement');
    } 

   
    
      public function addnewcustomer(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('supProcesses.addnewcustomer');
    }  
     public function addnewsupplier(){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('supProcesses.addnewsupplier');
    }
    

    public function stockAdjastment(){

        
        return view('supProcesses.stockAdjastment');
    }

    public function stock_update(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

     //   return   LaravelLocalization::getCurrentLocale();
        ;
        $productId=$request->productNo=='-'?$request->productname:$request->productNo;
    $updatedproduct=    products::where('id',$productId)->update(
            [
                'numberofpice'=>$request->newquentity
            ]
        );
if($updatedproduct!=null){
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم تعديل كمية المنتج بنجاح':"Product quantity has been modified successfully.";
    session()->flash('productupdated', $message);

}
return view('supProcesses.stockAdjastment');

    }




    public function update_product_movement(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        //   return   LaravelLocalization::getCurrentLocale();
           ;
           $productId=$request->productNo=='-'?$request->productname:$request->productNo;
       $updatedproduct=    products::where('id',$productId)->update(
               [
                   'Product_Location'=>$request->new_location
               ]
           );
   if($updatedproduct!=null){
       $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم تعديل موقع المنتج بنجاح':"Product location has been modified successfully.";
       session()->flash('productupdatedlocation', $message);
   
   }
        return view('supProcesses.product_movement');
    } 





    public function create_addnewProduct(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        $this->validate($request, [
            'product_name_ar' => 'required',
            'product_name_en' => 'required',
            'Section' => 'required',
            'product_location' => 'required',
            'product_code' => 'required|unique:products,Product_Code',
            'minmum_quantity_stock_alart' => 'required',
        ]);
     //return $request;

        $newcustomer=products::create(
            [
                'product_name'=>$request->product_name_ar,
                'name_en'=>$request->product_name_en ,
                'branchs_id'=>$request->Section,
                'user_id'=>Auth()->User()->id,
                'Product_Location'=>$request->product_location,
                'Product_Code'=>$request->product_code,
                'Status'=>1,
                'notes'=>$request->product_notes,
                'unit'=>$request->unit,
                'minmum_quantity_stock_alart'=>$request->minmum_quantity_stock_alart,
            ]
            );
if(  $newcustomer!=null){
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم اضافة المنتج بنجاح':'Product added successfully'   ;

    session()->flash('addProduct',$message);

}
        return view('supProcesses.addProduct');
    }


    public function create_addnewcustomer(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());
    //    return $request;

        $this->validate($request, [ 
            'name' => 'required',
            'email' => 'required|email',
            'phone'=>'required',
            'TaxـNumber' => 'required',
            'credit_limit' => 'required',
            'timeout_periodـinـdays' => 'required',

        ]);
$newcustomer=customers::create(
    [
        'name'=>$request->name,
        'email'=>$request->requestemail,
        'comp_name'=>$request->name,
        'address'=> "Client Address",
        'phone'=>  $request->phone  ,
        'email'=> $request->email  ,
        'notes'=>$request->product_notes,
        'Limit_credit'=>$request->credit_limit,
        'grace_period_in_days'=>$request->grace_period_in_days
    ]
    );
       // return $request;
       if(  $newcustomer!=null){
        $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم اضافة العميل بنجاح':'Client added successfully'   ;

        session()->flash('newcustomer',$message);
    
    }
        return view('supProcesses.addnewcustomer');
    }

    public function create_addnewsupplier(Request $request){
        app()->setLocale(LaravelLocalization::getCurrentLocale());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'loction' => 'required',
            'notes' => 'required',
            'TaxـNumber'=>'required',
            'comp_name' => 'required'
        ]);
               // return $request;

        $supllier=supllier::create(
            [
                'name'=>$request->name,
                'phone'=>$request->phone,
                'comp_name'=>$request->comp_name,
                'email'=>$request->email,
                'location'=>$request->loction,
                'notes'=>$request->notes,
                'TaxـNumber'=>$request->TaxـNumber
            ]
            );
            if(  $supllier!=null){
                $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم اضافة الموارد بنجاح':'Supplier added successfully'   ;

                session()->flash('addnewsupplier',$message);
            
            }
        //return $request;
        return view('supProcesses.addnewsupplier');
    }


    
}

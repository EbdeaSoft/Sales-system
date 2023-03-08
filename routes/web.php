<?php
use App\Http\Controllers\SupllierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\CustomersController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;
use  App\Http\Controllers\ProductsController;
use  App\Http\Controllers\AdminController;
use  App\Http\Controllers\InvoicesController;
use App\Models\sales;
use App\Models\supllier;
use App\Models\customers;
use App\Models\transactiontosuplliers;
use App\Http\Controllers\AcountesController;
use App\Http\Controllers\CredittransactionsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BranchsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\role_has_permissions;
use App\Http\Controllers\SupprocessesController;
use App\Http\Controllers\AvtController;
use App\Http\Controllers\EmployeeController;
use App\Models\credittransactions;

use  App\Models\resource_purchases;
use  App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/{page}', [App\Http\Controllers\AdminController::class,'index']);

//products









Route::post('/posttestajax',[BranchsController::class,'posttestajax']);




Route::get('/', function () {

            return view('auth.login');
        });
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


//role


Route::group(['middleware' => ['auth']], function() {
   
    Route::resource('roles',RoleController::class);
    
    Route::resource('users',UserController::class);
    
    });


//end role

  //products
  
  Route::get('showAllProducts',[ProductsController::class,'showAllProducts']);
 Route::get('printOrderPriceFromSupplier/{id}',[ProductsController::class,'printOrderPriceFromSupplier']);
  Route::get('getproductsquntitytocustomer',[ProductsController::class,'index']);
Route::get('getproductspricetocustomer',[ProductsController::class,'showProductsPrice']);
Route::get('getproductsprice',[ProductsController::class,'getProductsPriceFromSupplier']);
Route::get('getproduct/{id}',[ProductsController::class,'show']);
Route::get('getProductdJsonDecode/{id}',[ProductsController::class,'getProductdJsonDecode']);
Route::get('Purchase_returns',[ProductsController::class,'Purchase_returns']);
Route::get('purchases',[ProductsController::class,'purchases']);
Route::post('printavaliableproduct',[ProductsController::class,'create']);
Route::get('printavaliableproductprice',[ProductsController::class,'printProductPriceToCustomer']);
Route::post('printproductprice',[ProductsController::class,'printProductPrice']);
Route::post('print_all_products_price',[ProductsController::class,'print_all_products_price']);
Route::post('AddproducttoSupllier',[ProductsController::class,'AddproducttoSupllier']);
Route::post('Addproducttopurchases',[ProductsController::class,'Addproducttopurchases']);
Route::post('purchaseproduct_update',[ProductsController::class,'update']);
Route::post('purchaseproduct_delete',[ProductsController::class,'destroy']);
Route::get('goToSale',[ProductsController::class,'goToSale']);
Route::get('goToReceipt',[ProductsController::class,'goToReceipt']);
Route::post('order_price_from_suppliers',[ProductsController::class,'order_price_from_suppliers']);
Route::post('report_offer_price_customer',[ProductsController::class,'AddproductPriceToCustomer']);
Route::post('AddproductPriceToCustomer',[ProductsController::class,'AddproductPriceToCustomer']);
Route::get('print_order_perice_to_customer/{id}',[ProductsController::class,'print_order_perice_to_customer']);
Route::get('report_offer_price_customer',[ProductsController::class,'print_order_perice_to_customer']);





//end product




//++++++++++++++++++
//accountes

Route::get('voncher',[AcountesController::class,'voncher']);
Route::get('cashEcprnse',[AcountesController::class,'cashEcprnse']);
Route::get('income',[AcountesController::class,'income']);
Route::get('reciept_decoument',[AcountesController::class,'reciept_decoument']);
Route::get('/print_reciept/{id}',[AcountesController::class,'print_voucher']);
Route::get('/print_reciept_ducoument/{id}',[AcountesController::class,'print_reciept_ducoument']);




//end accountes






//++++++++++++++++++++
//Credittransactions


Route::post('Credittransactions',[CredittransactionsController::class,'create']);
Route::post('reciepttransactions',[CredittransactionsController::class,'store']);




//endCredittransactions




//+++++++++++++++++++
//Expenses

Route::post('Expenses',[ExpensesController::class,'store']);
Route::post('ExpensesOwner',[ExpensesController::class,'ExpensesOwner']);



//end Expenses




//+++++++++++++++++++
//invoices
Route::post('AddInvoices',[InvoicesController::class,'store']);
Route::post('Receipt',[InvoicesController::class,'Receipt']);
Route::post('EditInvoices',[InvoicesController::class,'edit']);
Route::get('printInvoice/{id}',[InvoicesController::class,'printInvoice']);
Route::post('return_sale',[InvoicesController::class,'return_sale']);
Route::get('return_sale',[InvoicesController::class,'index']);
Route::post('update_return_sale',[InvoicesController::class,'update']);
Route::get('printReceiptToStorehouse/{id}',[InvoicesController::class,'printReceiptToStorehouse']);





//endinvoices





//++++++++++++++++++++++++++++
//supllier


Route::get('Purchase_order_of_resources',[SupllierController::class,'index']);
Route::get('getsupllier/{id}',[SupllierController::class,'show']);
Route::get('printProductToSupllier/{id}',[SupllierController::class,'edit']);
Route::post('Purchase_returns_Data',[ProductsController::class,'Purchase_returns_Data']);





//end supplier
//+++++++++++++++++++++++++++
//users

Route::get('getallusers',[AdminController::class,'show']);
Route::get('updateuser/{id}',[AdminController::class,'edit']);
Route::get('deleteuser/{id}',[AdminController::class,'destroy']);


//end user





//+++++++++++++++++++++++++++
//customer


 Route::get('/getcustomer/{id}',[CustomersController::class,'show']);




//endcustomer



//+++++++++++++++
//Reports

Route::get('/employeeـsales',[ReportController::class,'employeeـsales']);
Route::get('/salesـprofits',[ReportController::class,'salesـprofits']);
Route::post('/salesReport',[ReportController::class,'salesReportsearch']);
Route::post('/salesـprofits',[ReportController::class,'salesـprofitssearch']);
Route::get('/salesReport',[ReportController::class,'salesReport']);
Route::post('/search_Requestـoffersـfromـsuppliers',[ReportController::class,'search_Requestـoffersـfromـsuppliers']);
Route::post('/employeeSalesSearch',[ReportController::class,'employeeSalesSearch']);
Route::get('/printInvoicesReport/{branch}/{paymethod}/{startat}/{endat}',[ReportController::class,'printInvoicesReport']);
Route::get('/report_returns_sale',[ReportController::class,'report_returns_sale']);
Route::post('/search_report_returns_sale',[ReportController::class,'search_report_returns_sale']);
Route::get('/printreturnInvoicesReport/{branch}/{startat}/{endat}',[ReportController::class,'print_return_Report']);
Route::get('/printReportProductSales/{branch}/{productId}/{startat}/{endat}',[ReportController::class,'printReportProductSales']);
Route::get('/printReportemployeeSales/{userId}/{startat}/{endat}',[ReportController::class,'printReportemployeeSales']);
Route::get('/printReportProfitSales/{branch_id}/{userId}/{startat}/{endat}',[ReportController::class,'printReportProfitSales']);
Route::get('/print_report_order_from_supplier/{SupplierId}/{startat}/{endat}',[ReportController::class,'print_report_order_from_supplier']);
Route::get('/printReportoffer_price_customer/{SupplierId}/{startat}/{endat}',[ReportController::class,'printReportoffer_price_customer']);
Route::get('/Requestـoffersـfromـsuppliers',[ReportController::class,'Requestـoffersـfromـsuppliers']);
Route::get('/product_sales',[ReportController::class,'product_sales']);
Route::post('/product_sales',[ReportController::class,'search_product_sales']);
Route::get('/report_offer_price_customer',[ReportController::class,'report_offer_price_customer']);
Route::post('/show_offer_price_customer',[ReportController::class,'show_offer_price_customer']);

Route::get('/Delivery_notes',[ReportController::class,'Delivery_notes']);
Route::post('/Delivery_notes',[ReportController::class,'search_Delivery_notes']);
Route::get('/printDelivery_notes/{orderId}/{startat}/{endat}',[ReportController::class,'printDelivery_notes']);


Route::get('/Requestـaـquoteـfromـtheـsupplier',[ReportController::class,'Requestـaـquoteـfromـtheـsupplier']);
Route::post('/Requestـaـquoteـfromـtheـsupplier',[ReportController::class,'search_Requestـaـquoteـfromـtheـsupplier']);
Route::get('/print_Requestـaـquoteـfromـtheـsupplier/{branchId}/{supplier}/{startat}/{endat}',[ReportController::class,'print_Requestـaـquoteـfromـtheـsupplier']);

Route::get('/Purchasesـfromـsuppliers',[ReportController::class,'Purchasesـfromـsuppliers']);
Route::post('/Purchasesـfromـsuppliers',[ReportController::class,'search_Purchasesـfromـsuppliers']);
Route::get('/print_Purchasesـfromـsuppliers/{branch}/{pay}/{startat}/{endat}',[ReportController::class,'print_Purchasesـfromـsuppliers']);
Route::get('Refundـofـresourceـpurchases',[ReportController::class,'Refundـofـresourceـpurchases']);

Route::post('/Refundـofـresourceـpurchases',[ReportController::class,'search_Refundـofـresourceـpurchases']);
Route::get('/print_Refundـofـresourceـpurchases/{branch_id}/{startat}/{endat}',[ReportController::class,'print_Refundـofـresourceـpurchases']);


Route::get('/purchasereports',[ReportController::class,'purchasereports']);
Route::post('/purchasereports',[ReportController::class,'search_purchasereports']);
Route::get('/print_purchasereports/{productId}/{startat}/{endat}',[ReportController::class,'print_purchasereports']);

Route::get('/customerـpurchases',[ReportController::class,'customerـpurchases']);
Route::post('/customerـpurchases',[ReportController::class,'search_customerـpurchases']);
Route::get('/print_customerـpurchases/{branchId}/{customerId}/{startat}/{endat}',[ReportController::class,'print_customerـpurchases']);

Route::get('/credit_collection',[ReportController::class,'credit_collection']);
Route::post('/credit_collection',[ReportController::class,'search_credit_collection']);
Route::get('/print_credit_collection/{userId}/{startat}/{endat}',[ReportController::class,'print_credit_collection']);



Route::get('/supplierlist',[ReportController::class,'supplierList']);
Route::get('/print_supplierlist/{userId}/{startat}/{endat}',[ReportController::class,'print_supplierlist']);

Route::get('/print_SupplierList',[ReportController::class,'print_supplierList']);



Route::get('/Supplier_credit_payment',[ReportController::class,'Supplier_credit_payment']);
Route::post('/Supplier_credit_payment',[ReportController::class,'search_Supplier_credit_payment']);
Route::get('/print_Supplier_credit_payment/{supplierId}/{startat}/{endat}',[ReportController::class,'print_Supplier_credit_payment']);

Route::get('/shift_detailes',[ReportController::class,'shift_detailes']);
Route::post('/shift_detailes',[ReportController::class,'search_shift_detailes']);
Route::get('/print_shift_detailes/{branch_id}/{paumethod}/{startat}/{endat}',[ReportController::class,'print_shift_detailes']);


Route::get('/Expensesreport',[ReportController::class,'Expenses']);
Route::post('/Expensesreport',[ReportController::class,'search_Expenses']);
Route::get('/printExpensesReport/{branch_id}/{startat}/{endat}',[ReportController::class,'printExpensesReportlast']);

Route::get('/stockquantity',[ReportController::class,'stockquantity']);
Route::post('/stockquantity',[ReportController::class,'search_stockquantity']);
Route::get('/printstockquantity/{branch_id}',[ReportController::class,'printstockquantity']);


Route::get('/Best_selling_products',[ReportController::class,'Best_selling_products']);
Route::post('/Best_selling_products',[ReportController::class,'search_Best_selling_products']);
Route::get('/printBest_selling_products/{branch_id}',[ReportController::class,'printBest_selling_products']);


Route::get('/VAT',[ReportController::class,'VAT']);
Route::post('/VAT',[ReportController::class,'search_VAT']);
Route::get('/print_VAT/{branch_id}/{startat}/{endat}',[ReportController::class,'print_VAT']);




Route::get('/Customersـexceededـgraceـperiod',[ReportController::class,'Customersـexceededـgraceـperiod']);

Route::get('/budgetsheet',[ReportController::class,'budgetsheet']);
Route::post('/budgetsheet',[ReportController::class,'search_budgetsheet']);


//endReport

//supProcesses


Route::get('/addnewProduct',[SupprocessesController::class,'index']);
Route::post('/addnewProduct',[SupprocessesController::class,'create_addnewProduct']);



Route::get('/addnewcustomer',[SupprocessesController::class,'addnewcustomer']);
Route::post('/addnewcustomer',[SupprocessesController::class,'create_addnewcustomer']);



Route::get('/addnewsupplier',[SupprocessesController::class,'addnewsupplier']);
Route::post('/addnewsupplier',[SupprocessesController::class,'create_addnewsupplier']);




Route::get('/stockAdjastment',[SupprocessesController::class,'stockAdjastment']);
Route::post('/stockAdjastment',[SupprocessesController::class,'stock_update']);


Route::get('/product_movement',[SupprocessesController::class,'product_movement']);
Route::post('/product_movement',[SupprocessesController::class,'update_product_movement']);


//end Supprocesses


//usersAndBranch

Route::get('/addbranch',[BranchsController::class,'index']);
Route::post('/addbranch',[BranchsController::class,'create']);











//endUsersAndBranch


//show branches

Route::get('/showbranches',[BranchsController::class,'show']);
Route::post('/updatebranch',[BranchsController::class,'updatebranch']);



//end branches

//AVT
Route::get('/avt',[AvtController::class,'index']);
Route::post('/update_vat',[AvtController::class,'update']);
Route::post('/New_avt',[AvtController::class,'store']);
Route::post('/destory_avt',[AvtController::class,'destroy']);





//END avt

//Hr

Route::get('/createNewEmployee',[EmployeeController::class,'index']);
Route::post('/createNewEmployee',[EmployeeController::class,'create']);
Route::get('/allEmployees',[EmployeeController::class,'show']);


Route::get('/addnewDepartment',[EmployeeController::class,'addnewDepartment']);
Route::post('/addnewDepartment',[EmployeeController::class,'store']);

Route::get('/updateEmployee/{id}',[EmployeeController::class,'updateEmployee']);
Route::post('/updateEmployee',[EmployeeController::class,'update']);

Route::get('/Increaseـor_deduction',[EmployeeController::class,'Increaseـor_deduction']);

Route::post('/Increaseـor_deduction',[EmployeeController::class,'Increaseـor_deduction_add']);

Route::get('/salarydecoument',[EmployeeController::class,'salarydecoument']);

Route::post('/print_decument_salary',[EmployeeController::class,'print_decument_salary']);




//end Hr







// Home Screen
Route::get('/dashboard', function () {
 //   return resource_purchases::whereDate('created_at','>=',(date("Y").'-02'.'-01'))->whereDate('created_at','<',(date("Y").'-03'.'-01'))->get();
$user=Auth()->user();
;
//return Spatie\Permission\Models\Role::get();
 $salling_month=10;
$prechese_month=90;
    app()->setLocale(LaravelLocalization::getCurrentLocale());
    $chartjs3 = 
     app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 700, 'height' => 200])
            ->labels([__('home.purchases_number_SOLD'), __('home.PRODUCT_number_SOLD')])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => [$prechese_month,$salling_month]
                ]
            ])
            ->options([]);
    $chartjs2 = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 150])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July','August','Semptemper',
        'October','November','December'])
        ->datasets([
         
            [
                "label" => __('home.sales'),
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [
                    sales::whereDate('created_at','>=',(date("Y").'-01'.'-01'))->whereDate('created_at','<',(date("Y").'-02'.'-01'))->count() ,
                sales::whereDate('created_at','>=',(date("Y").'-02'.'-01'))->whereDate('created_at','<',(date("Y").'-03'.'-01'))->count() ,
                sales::whereDate('created_at','>=',(date("Y").'-03'.'-01'))->whereDate('created_at','<',(date("Y").'-04'.'-01'))->count() 
                , sales::whereDate('created_at','>=',(date("Y").'-04'.'-01'))->whereDate('created_at','<',(date("Y").'-05'.'-01'))->count() 
                , sales::whereDate('created_at','>=',(date("Y").'-05'.'-01'))->whereDate('created_at','<',(date("Y").'-06'.'-01'))->count() 
                , sales::whereDate('created_at','>=',(date("Y").'-06'.'-01'))->whereDate('created_at','<',(date("Y").'-07'.'-01'))->count() 
                , sales::whereDate('created_at','>=',(date("Y").'-07'.'-01'))->whereDate('created_at','<',(date("Y").'-08'.'-01'))->count() 
                ,sales::whereDate('created_at','>=',(date("Y").'-08'.'-01'))->whereDate('created_at','<',(date("Y").'-09'.'-01'))->count() 
                ,sales::whereDate('created_at','>=',(date("Y").'-09'.'-01'))->whereDate('created_at','<',(date("Y").'-10'.'-01'))->count() 
                ,sales::whereDate('created_at','>=',(date("Y").'-10'.'-01'))->whereDate('created_at','<',(date("Y").'-11'.'-01'))->count() ,
                sales::whereDate('created_at','>=',(date("Y").'-11'.'-01'))->whereDate('created_at','<',(date("Y").'-12'.'-01'))->count() ,
                sales::whereDate('created_at','>=',(date("Y").'-12'.'-01'))->whereDate('created_at','<',(date("Y").'-12'.'-30'))->count() ,
            ],],
            [
                "label" => __('home.purchases'),
                'backgroundColor' =>'rgba(54, 162, 235, 0.7)',
                'borderColor' => 'rgba(54, 162, 235, 0.7)',
                "pointBorderColor" => 'rgba(54, 162, 235, 0.7)',
                "pointBackgroundColor" =>'rgba(54, 162, 235, 0.7)',
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => 'rgba(54, 162, 235, 0.7)',
                'data' => [resource_purchases::whereDate('created_at','>=',(date("Y").'-01'.'-01'))->whereDate('created_at','<',(date("Y").'-02'.'-01'))->count() ,
                resource_purchases::whereDate('created_at','>=',(date("Y").'-02'.'-01'))->whereDate('created_at','<',(date("Y").'-03'.'-01'))->count() ,
                resource_purchases::whereDate('created_at','>=',(date("Y").'-03'.'-01'))->whereDate('created_at','<',(date("Y").'-04'.'-01'))->count() 
                , resource_purchases::whereDate('created_at','>=',(date("Y").'-04'.'-01'))->whereDate('created_at','<',(date("Y").'-05'.'-01'))->count() 
                , resource_purchases::whereDate('created_at','>=',(date("Y").'-05'.'-01'))->whereDate('created_at','<',(date("Y").'-06'.'-01'))->count() 
                , resource_purchases::whereDate('created_at','>=',(date("Y").'-06'.'-01'))->whereDate('created_at','<',(date("Y").'-07'.'-01'))->count() 
                , resource_purchases::whereDate('created_at','>=',(date("Y").'-07'.'-01'))->whereDate('created_at','<',(date("Y").'-08'.'-01'))->count() 
                ,resource_purchases::whereDate('created_at','>=',(date("Y").'-08'.'-01'))->whereDate('created_at','<',(date("Y").'-09'.'-01'))->count() 
                ,resource_purchases::whereDate('created_at','>=',(date("Y").'-09'.'-01'))->whereDate('created_at','<',(date("Y").'-10'.'-01'))->count() 
                ,resource_purchases::whereDate('created_at','>=',(date("Y").'-10'.'-01'))->whereDate('created_at','<',(date("Y").'-11'.'-01'))->count() ,
                 resource_purchases::whereDate('created_at','>=',(date("Y").'-11'.'-01'))->whereDate('created_at','<',(date("Y").'-12'.'-01'))->count() ,
                 resource_purchases::whereDate('created_at','>=',(date("Y").'-12'.'-01'))->whereDate('created_at','<',(date("Y").'-12'.'-30'))->count() ,
            ],
            ]]
            )
        ->options([]);
        

        $customersdebit=customers::where('Balance','!=',0)->get();
        $salesdebit=0;
        $salesdebit_paid=0;
        $purchese_debit=0;
        $purchese_debit_paid=0;

        foreach($customersdebit as $customer){
        $salesdebit+=$customer->Balance;
       }

       $customersdebit_paid=credittransactions::get();
       foreach($customersdebit_paid as $customer){
        $salesdebit_paid+=$customer->recive_amount;
       }
       $credit_suplliers=supllier::get();
       foreach($credit_suplliers as $supllier){
        $purchese_debit+=$supllier->In_debt;
       }

       $credit_suplliers_paid=transactiontosuplliers::get();
       foreach($credit_suplliers_paid as $supllier){
        $purchese_debit_paid+=$supllier->paidـamount;
       }


       
        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 700, 'height' => 200])
        ->labels([__('home.creditsales'), __('home.creditpurchese')])
        ->datasets([
       
            [
                "label" => __('home.Paymenthasnotbeenmade'),
                'backgroundColor' => ['rgba(255, 99, 132, 0.8)','rgba(255, 99, 132, 0.8)' ],
                'data' => [$salesdebit, $purchese_debit]
            ],
            [
                "label" =>__('home.Thepaymentwasmade'),
                'backgroundColor' => ['rgba(54, 162, 235, 0.8)','rgba(54, 162, 235, 0.8)' ],
                'data' => [$salesdebit_paid, $purchese_debit_paid]
            ]
        ])
        ->options([]);


$charts=[$chartjs,$chartjs2,$chartjs3];
//test
$startDate = (date("Y-m")).'-1';
$endDate =  date('Y-m-d ', strtotime('+1 day'));
$x= sales::whereBetween('created_at', [(date("Y-m")).'-1', date('Y-m-d ', strtotime('+1 day'))])->count();
// sales::whereDate('created_at',date("Y-m-d"))->count();
//return $x;
//test
        return view('index',compact('charts'));
    })->name('dashboard');
    Route::get('/{page}', function ($page) {
    
        if(view()->exists($page)){
            return view($page);
        }
        else
        {
            return view('404');
        }});

});


        
        
     




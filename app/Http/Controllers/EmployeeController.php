<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;
use  App\Models\departments;
use App\Models\Increaseـor_deduction_employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
     public function addnewDepartment()
     {
         //
         app()->setLocale(LaravelLocalization::getCurrentLocale());
 
         return view('hr.Add_new_department');
     }


     public function salarydecoument()
     {
         //
         app()->setLocale(LaravelLocalization::getCurrentLocale());
 
         return view('hr.salarydecoument');
     }
     


     public function Increaseـor_deduction()
     {
         //
         app()->setLocale(LaravelLocalization::getCurrentLocale());
 
         return view('hr.Increaseـor deduction');
     }

     


    public function index()
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('hr.Add_employee');
    }

    public function updateEmployee($id)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());
       $employee= employee::find($id);
        return view('hr.update_employee',compact('employee'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

      //  return $request;
      $this->validate($request, [
          
        'personal_identification' => 'required|unique:employees,personal_identification',
        'email' => 'required|unique:employees,email',
    ]);
        $employee=employee::create([
            'name_ar'=>$request->employee_name_ar,
            'name_en'=>$request->employee_name_en,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'department'=>$request->department,
            'salary'=>$request->salary,
            'nationality'=>$request->nationality,
            'personal_identification'=>$request->personal_identification,
            'old'=>$request->age,
            'sex'=>$request->sex,
            'created_at'=> \Carbon\Carbon::now()->addHours(3),        ]
        );
    
if( $employee!=null){
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم إضافة الموظف بنجاح':'  Employee created successfully';
        session()->flash('create_employee',$message);
}
return view('hr.Add_employee');

 } /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
          
            'name_ar' => 'required|unique:departments,name_ar',
            'name_en' => 'required|unique:departments,name_en',
        ]);
        app()->setLocale(LaravelLocalization::getCurrentLocale());
        $employee=departments::create([
            'name_ar'=>$request->department_name_ar,
            'name_en'=>$request->department_name_en,

            'created_at'=> \Carbon\Carbon::now()->addHours(3),        ]
        );
    
if( $employee!=null){
    $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم إضافة القسم بنجاح':'  Department created successfully';
        session()->flash('create_department',$message);
}
        return view('hr.Add_new_department');
    }



    

    public function print_decument_salary(Request $request)
    {
        //
    // return $request;
    $start=$request->end_at.'-01';
    $end=$request->end_at.'-31';
    $list_salary_data=[];
        app()->setLocale(LaravelLocalization::getCurrentLocale());
        $employees=employee::get();
    foreach($employees as $employee)
    {
$bounes=0;
$discount=0;

foreach(Increaseـor_deduction_employee::where('employee_id',$employee->id)->whereDate('created_at','>=', $start) ->whereDate('created_at', '<=', $end) ->get()  as $Increaseـor_deduction_employee)
{
    $bounes+=$Increaseـor_deduction_employee->increase;
    $discount+=$Increaseـor_deduction_employee->deduction; 
}

$list_salary_data[]=[
    'employeeData'=> $employee,
    'bounes'=>$bounes,
    'discount'=>$discount
    
        ];
    }

   
// return $list_salary_data;

        return view('hr.employee_salary_list_print',compact('list_salary_data'));
    }




    public function Increaseـor_deduction_add(Request $request)
    {
        //
        // return $request;

        if($request->increasValue!=0)
        {
            $employee=Increaseـor_deduction_employee::create([
                'employee_id'=>$request->department,
                'deduction'=>$request->department,
                'increase'=>$request->increasValue,
                'created_at'=> \Carbon\Carbon::now()->addHours(3),        ]
            );
        
    if( $employee!=null){
        $employee= employee::find($request->id);
        $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم إضافة مكافأة بنجاح ':' Add bonus successfully ';
            session()->flash('create_department',$message);
    }
            return view('hr.Increaseـor deduction');
        }
        
        else{
            $employee=Increaseـor_deduction_employee::create([
                'employee_id'=> $request->department,
                'deduction'=>$request->decreaseValue,
                'increase'=>$request->increasValue,
                'created_at'=> \Carbon\Carbon::now()->addHours(3),        ]
            );
        
    if( $employee!=null){
        $employee= employee::find($request->id);
        $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم إضافة مكافأة بنجاح ':' Add bonus successfully ';
            session()->flash('create_department',$message);
    }
            return view('hr.Increaseـor deduction');
        }
    }







    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

        return view('hr.show_employee');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        app()->setLocale(LaravelLocalization::getCurrentLocale());

       //  return $request;
  
          $employee=employee::where('personal_identification',$request->personal_identification)->update([
              'name_ar'=>$request->employee_name_ar,
              'name_en'=>$request->employee_name_en,
              'email'=>$request->email,
              'phone'=>$request->phone,
              'department'=>$request->department,
              'salary'=>$request->salary,
              'nationality'=>$request->nationality,
              'personal_identification'=>$request->personal_identification,
              'old'=>$request->age,
              'sex'=>$request->sex,
              'created_at'=> \Carbon\Carbon::now()->addHours(3),        ]
          );
      
  if( $employee!=null){
      $message=LaravelLocalization::getCurrentLocale()=='ar'?'تم تعديل بيانات الموظف بنجاح':'  Employee updated successfully';
          session()->flash('updated_employee',$message);
  }
  $employee= employee::where('personal_identification',$request->personal_identification)->first();
  //return $employee;
        return view('hr.update_employee',compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        //
    }
}

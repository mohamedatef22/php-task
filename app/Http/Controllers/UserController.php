<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function addEmployee()
    {
        return view('Dashboard.User.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|max:255',
            "email"=>"email|required|max:255|unique:users,email",
            "password"=>"required"
        ]);

        $user = User::create([
            "name"=>$request->get('name'),
            "password"=> Hash::make($request->get('password')),
            "email"=> $request->get('email'),
            "role"=>User::EMPLOYEE_ROLE
        ]);
        return redirect()->back()->with(["success"=>true,"message"=>"Added Successfully"]);
    }

    public function addCustomer()
    {
        $employees = User::where('role','=',User::EMPLOYEE_ROLE)->get();
        return view('Dashboard.User.add-customer',compact('employees'));
    }

    public function storeCustomer(Request $request)
    {
        if($request->get('employee_id') == 0){
            $request->request->remove('employee_id');
        }

        $validated = $request->validate([
            'name'=>'required|max:255',
            "email"=>"email|required|max:255|unique:users,email",
            "password"=>"required",
            "employee_id"=>"exists:users,id"
        ]);

        $user = User::create([
            "name"=>$request->get('name'),
            "password"=> Hash::make($request->get('password')),
            "email"=> $request->get('email'),
            "role"=>User::CUSTOMER_ROLE
        ]);

        $employee_id = $request->get('employee_id',null);
        
        if(!$employee_id && Auth::user()->role === User::EMPLOYEE_ROLE){
            $employee_id = Auth::user()->id;
        }

        if($employee_id){
            $user->employee_id = $employee_id;
            $user->save();
        }

        return redirect()->back()->with(["success"=>true,"message"=>"Added Successfully"]);
    }

    public function getCustomers()
    {
        if(Auth::user()->role === User::ADMIN_ROLE){
            $customers = User::where('role','=',User::CUSTOMER_ROLE)->with('myEmployee')->get();
        }
        else{
            $customers = Auth::user()->myCustomers->load('myEmployee');
        }
        return view('Dashboard.User.all',compact('customers'));
    }

    public function showCustomer(User $customer)
    {
        if($customer->role !== User::CUSTOMER_ROLE) abort(404);
        $customer->load('myEmployee','customerActions');
        $employees = null;
        if(!$customer->myEmployee) $employees = User::where('role','=',User::EMPLOYEE_ROLE)->get();

        return view('Dashboard.User.show',compact('customer','employees'));
    }

    public function assignEmployee(Request $request,User $customer)
    {
        $validated = $request->validate([
            'employee_id'=>"required|exists:users,id"
        ]);

        $customer->employee_id = $request->get('employee_id');
        $customer->save();

        return redirect()->back()->with(["success"=>true,"message"=>"Assigned Successfully"]);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    
}

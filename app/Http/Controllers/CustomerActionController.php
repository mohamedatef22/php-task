<?php

namespace App\Http\Controllers;

use App\Models\CustomerAction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerActionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    public function store(Request $request,User $customer)
    {
        $validated = $request->validate([
            'action'=>"required",
        ]);

        $action = CustomerAction::create([
            'employee_id'=> Auth::user()->id,
            'customer_id'=> $customer->id,
            'action'=>request()->get('action'),
            'result'=>request()->get('result')
        ]);

        return redirect()->back()->with(["success"=>true,"message"=>"Assigned Successfully"]);
    }

}

<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Prop\HomeType;
use App\Models\Prop\Property;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function viewLogin()
    {

        return view('admins.login');

    }
    
    public function checkLogin(Request $request)
    {
        
        // $remember_me = $request->has('remember_me') ? true : false;
        
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            
            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
        
    }
    public function index()
    {

        $propsCount = Property::select()->count();
        $homeTypeCount = HomeType::select()->count();
        $adminCount = Admin::select()->count();
    
        return view('admins.dashboard', compact('propsCount', 'homeTypeCount', 'adminCount'));
    
    }
}

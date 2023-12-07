<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Prop\HomeType;
use App\Models\Prop\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function allAdmins()
    {

        $admins = Admin::all();

        return view('admins.allAdmins', compact('admins'));

    }

    public function addAdmin()
    {

        return view('admins.addAdmin');

    }

    public function storeAdmin(Request $request)
    {

        //validation of input fields
        $validatedData = $request->validate([
            'name' => "required",
            'email' => "required|unique:admins",
            'password' => "required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[A-Za-z\d\p{P}\p{S}]{8,}$/u",
        ]);

        if ($validatedData) {

            $newAdmin = new Admin;
            $newAdmin->name = $request->input('name');
            $newAdmin->email = $request->input('email');
            $newAdmin->password = Hash::make($request->input('password'));
            $newAdmin->save();

            return redirect()->route('admins.all')->with(['success' => 'New Admin user added successfully!']);
        }

        return redirect()->route('admins.all')->with(['error' => 'Error: new Admin user creation failed. Try again!']);

    }


    public function allHomeTypes()
    {

        $homeTypes = HomeType::all();

        return view('admins.allhometypes', compact('homeTypes'));

    }

    public function addHomeTypes()
    {

        return view('admins.addHomeTypes');

    }

    public function storeHomeTypes(Request $request)
    {

        //validation of input fields
        $validatedData = $request->validate([
            'home_type' => "required|unique:hometypes",
        ]);

        if ($validatedData) {

            $newHomeType = new HomeType;
            $newHomeType->home_type = $request->input('home_type');
            $newHomeType->save();

            return redirect()->route('admins.allhometypes')->with(['success' => 'New home type added successfully!']);
        }

        return redirect()->route('admins.allhometypes')->with(['error' => 'Error: new home type creation failed. Try again!']);

    }

    public function editHomeTypes($id)
    {

        $homeType = HomeType::findOrFail($id);

        if ($homeType) {

            return view('admins.updateHomeTypes', compact('id'));
        }

        return redirect()->route('admins.allhometypes')->with(['error' => 'Error: home type selected not found. Try again!']);
    }

    public function updateHomeTypes(Request $request, $id)
    {

        //validation of input fields
        $validatedData = $request->validate([
            'home_type' => "required|unique:hometypes",
        ]);

        if ($validatedData) {

            $homeType = HomeType::findOrFail($id);
            $homeType->home_type = $request->input('home_type');
            $homeType->update();

            return redirect()->route('admins.allhometypes')->with(['success' => 'Home type updated successfully!']);
        }

        return redirect()->route('admins.allhometypes')->with(['error' => 'Error: Home type update failed. Try again!']);

    }


    public function deleteHomeTypes($id)
    {

        $homeType = HomeType::findOrFail($id);

        if ($homeType) {

            $homeType->delete();

            return redirect()->route('admins.allhometypes')->with(['success' => 'Home type deleted successfully!']);
        }

        return redirect()->route('admins.allhometypes')->with(['error' => 'Error: home type selected not deleted. Try again!']);
    }
}

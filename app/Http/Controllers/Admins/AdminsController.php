<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Prop\HomeType;
use App\Models\Prop\Prop_image;
use App\Models\Prop\Property;
use App\Models\Prop\RequestInfo;
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

    public function allProperties()
    {

        $properties = Property::all();

        return view('admins.allProperties', compact('properties'));

    }

    public function addProperties()
    {

        return view('admins.addProperties');

    }

    public function storeProperties(Request $request)
    {

        //validation of input fields
        $validatedData = $request->validate([
            'title' => "required|unique:props,title|max:200",
            'price' => "required",
            'image' => "required|mimes:jpeg,png,jpg,svg",
            'beds' => "required",
            'baths' => "required",
            'sq_ft' => "required",
            'home_type' => "required",
            'year_built' => "required",
            'price_sqft' => "required",
            'more_info' => "required|max:200",
            'location' => "required|max:200",
            'type' => "required",
            'agent_name' => "required",

        ]);

        if ($validatedData) {

            $newProp = new Property;
            $newProp->title = $request->input('title');
            $newProp->price = $request->input('price');

            //check if passed image
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                //get name image
                $filename = $file->getClientOriginalName();

                //store image in folder /public/images
                $request->image->move(public_path('/assets/images'), $filename);
            }


            $newProp->image = $filename;
            $newProp->beds = $request->input('beds');
            $newProp->baths = $request->input('baths');
            $newProp->sq_ft = $request->input('sq_ft');
            $newProp->home_type = $request->input('home_type');
            $newProp->year_built = $request->input('year_built');
            $newProp->price_sqft = $request->input('price_sqft');
            $newProp->more_info = $request->input('more_info');
            $newProp->location = $request->input('location');
            $newProp->type = $request->input('type');
            $newProp->agent_name = $request->input('agent_name');
            $newProp->save();

            return redirect()->route('admins.allProperties')->with(['success' => 'New property added successfully!']);
        }

        return redirect()->route('admins.allProperties')->with(['error' => 'Error: new property creation failed. Try again!']);

    }


    public function addGallery()
    {

        $properties = Property::select('id', 'title')->get();

        return view('admins.create-gallery', compact('properties'));

    }

    public function storeGallery(Request $request)
    {

        //check if passed images
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {

                //get name image
                $filename = $file->getClientOriginalName();

                //store image in folder /public/images
                $file->move(public_path('/assets/images'), $filename);

                $newPropImg = new Prop_image;
                $newPropImg->prop_id = $request->input('prop_id');
                $newPropImg->image = $filename;

                $newPropImg->save();
            }

        }


        return redirect()->route('admins.allProperties')->with(['success' => 'New property images added to galley!']);

    }

    public function deleteProperties($id)
    {

        $property = Property::findOrFail($id);

        if ($property) {

            //find gallery images for this property
            $galleryImages = Prop_image::where('prop_id', $id)->pluck('image')->toArray();

            if (count($galleryImages) > 0) {

                //add property image to delete either
                $galleryImages[] = $property->image;

                foreach ($galleryImages as $galleryImage) {

                    //check image file exists in path and delete it
                    if (file_exists(public_path('assets/images/' . $galleryImage))) {
                        unlink(public_path('assets/images/' . $galleryImage));
                    } else {
                        continue;
                    }
                }
            } else {
                //check and delete only property image
                if (file_exists(public_path('assets/images/' . $property->image))) {
                    unlink(public_path('assets/images/' . $property->image));
                }
            }


            $property->delete();

            return redirect()->route('admins.allProperties')->with(['success' => 'Property deleted successfully!']);
        }

        return redirect()->route('admins.allProperties')->with(['error' => 'Error: property selected not deleted. Try again!']);
    }


    public function allRequests()
    {

        $requests = RequestInfo::all();

        return view('admins.allRequests', compact('requests'));

    }
}

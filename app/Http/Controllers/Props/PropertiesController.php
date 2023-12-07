<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use App\Models\Prop\Prop_image;
use App\Models\Prop\Property;
use App\Models\Prop\RequestInfo;
use App\Models\Prop\SavedProp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Auth;

class PropertiesController extends Controller
{
    public function index()
    {

        $properties = Property::select()->take(9)->orderBy('created_at', 'asc')->get();
        return view('home', compact('properties'));
    }

    public function single($id)
    {

        $propertyInfo = Property::find($id);

        $prop_images = Prop_image::where('prop_id', $id)->get();

        $relatedProps = Property::where('home_type', $propertyInfo->home_type)->where('id', '!=', $id)->take(3)->orderBy('created_at', 'desc')->get();

        //check if user logged in
        if (Auth::check()) {

            //check if already sent message with the form
            $messageSent = RequestInfo::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();

            //check if property already saved
            $savedProperty = savedProp::where('prop_id', $id)->where('user_id', Auth::user()->id)->count();
        } else {

            //if used ->with after view, check in blade as a variable $notAuth
            return view('property.property_details', compact('propertyInfo', 'prop_images', 'relatedProps'))->with('notAuth', 'Not authorized');

        }


        return view('property.property_details', compact('propertyInfo', 'prop_images', 'relatedProps', 'messageSent', 'savedProperty'));
    }

    public function insertRequest(Request $request)
    {

        //validation of input fields
        $validatedData = $request->validate([
            'prop_id' => "required",
            'agent_name' => "required",
            'user_id' => "required",
            'name' => "required|max:40",
            'email' => "required|email",
            'phone' => "required|max:12",
        ]);

        //if validation ok, save new record in DB
        if ($validatedData) {

            $insertRequest = new RequestInfo;
            $insertRequest->prop_id = $request->input('prop_id');
            $insertRequest->agent_name = $request->input('agent_name');
            $insertRequest->user_id = $request->input('user_id');
            $insertRequest->name = $request->input('name');
            $insertRequest->email = $request->input('email');
            $insertRequest->phone = $request->input('phone');
            $insertRequest->save();

            return redirect()->back()->with('success', 'Message sent successfully!');
        }

        return redirect()->back()->with('failed', 'Failed to send message, try it again in few minutes!');
    }

    public function saveProps(Request $request)
    {


        $saveProp = new SavedProp;
        $saveProp->prop_id = $request->input('prop_id');
        $saveProp->user_id = Auth::user()->id;
        $saveProp->title = $request->input('title');
        $saveProp->image = $request->input('image');
        $saveProp->location = $request->input('location');
        $saveProp->price = $request->input('price');
        $saveProp->save();

        return redirect()->back()->with('success', 'Property saved successfully!');

    }

    public function propsToBuy()
    {

        $type = "Buy";

        $properties = Property::where('type', $type)->take(9)->orderBy('created_at', 'desc')->get();
        return view('property.buy', compact('properties'));
    }

    public function propsToRent()
    {

        $type = "Rent";

        $properties = Property::where('type', $type)->take(9)->orderBy('created_at', 'desc')->get();
        return view('property.rent', compact('properties'));
    }

    public function displayHomeType($homeType)
    {

        $properties = Property::where('home_type', $homeType)->take(9)->orderBy('created_at', 'desc')->get();

        $homeType = strtoupper($homeType);
        return view('property.home_type', compact('homeType', 'properties'));
    }

    public function orderByPriceAsc()
    {

        $prices = Property::orderBy('price', 'asc')->get();

        //return json to elaborate data with javascript
        return response()->json(['prices' => $prices]);
    }

    public function orderByPriceDesc()
    {

        $prices = Property::orderBy('price', 'desc')->get();

        //return json to elaborate data with javascript
        return response()->json(['prices' => $prices]);
    }

    public function searchProps(Request $request)
    {

        $listTypes = $request->get('list-types');
        $offerTypes = $request->get('offer-types');
        $selectCity = $request->get('select-city');
        
        $searchProps = Property::where('home_type', $listTypes)->where('type',$offerTypes )->where('location', 'LIKE', '%' . $selectCity . '%')->get();

        if($searchProps->count() > 0){
            return view('property.search-result', compact('searchProps','listTypes','offerTypes','selectCity'));
        }

        
        return redirect()->back()->with('searchEmpty', 'No properties found for this search!');
    }

}

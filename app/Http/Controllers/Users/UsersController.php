<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Prop\Property;
use App\Models\Prop\RequestInfo;
use App\Models\Prop\SavedProp;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function allRequests(){

        $allRequests = RequestInfo::where('user_id',Auth::user()->id)->pluck('prop_id')->toArray();

        if(count($allRequests) > 0){

            $propsInfo = Property::whereIn('id', $allRequests)->get();
            return view('users.displayrequests', compact('allRequests', 'propsInfo'));
        }

        return view('users.displayrequests', compact('allRequests'));

    }
    
    public function savedProperties(){

        $savedProperties = SavedProp::where('user_id',Auth::user()->id)->get();

        return view('users.savedProperties', compact('savedProperties'));

    }


}

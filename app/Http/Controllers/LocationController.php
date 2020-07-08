<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class LocationController extends Controller
{


    public function addLocation(Request $request){

        if( !$request->description ){
            return response()->json([
                'error' => 1,
                'message' => 'قم بكتابة وصف للمكان',
            ]);
        }

        $checkExistance = Location::updateOrCreate([
            'user_id' => auth()->id(),
            'lat' => $request->lat,
            'lng' => $request->lng
        ], [
            'description' => $request->description,
        ]);

        $locations = Location::where('user_id', auth()->id())->get();

        return response()->json([
            'error' => 0,
            'message' => 'تم حفظ البيانات',
            'locations' => $locations,
        ]);

    }











    public function deleteAccountLocation(Request $request){

        $lat = $request->lat;
        $lng = $request->lng;
        $info = $lat .":".$lng;
        $deleteLocation = Location::where('user_id', auth()->id())->where('lat', $lat)->where('lng', $lng)->delete();
        return response()->json([ 'error' => 0, 'message' => trans('dashboard.deleted_successfully'), 'location' => $request->lat ]);

    }






}/* /CLASS */

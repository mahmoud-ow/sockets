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

        $checkExistance = Location::where('lat', $request->lat)->where('long', $request->lng)->get();

        if( $checkExistance->count() > 0 ){
            return response()->json([
                'error' => 1,
                'message' => 'هذا المكان مسجل مسبقا',
            ]);
        }

        $create = Location::create([
            'user_id' => auth()->id(),
            'lat' => $request->lat,
            'long' => $request->lng,
            'description' => $request->description,
        ]);

        return response()->json([
            'error' => 0,
            'message' => 'done',
        ]);

    }











    public function deleteAccountLocation(Request $request){

       $lat = round($request->lat, 8);
       $lng = round($request->lng, 8);


        $deleteLocation = Location::where('user_id', auth()->id())->where('lat', $lat)->where('long', $lng)->delete();
        return response()->json([ 'error' => 0, 'message' => trans('dashboard.deleted_successfully') ]);

    }






}/* /CLASS */

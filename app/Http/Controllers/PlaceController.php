<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\WorkRecord;

class PlaceController extends Controller
{
    //
    public function ViewPlaces(){
        //$myplaceData = Place::all();
        $data['myPlaceData'] = Place::all();
        return view('index', $data);
    }
    public function CreatePlace(Request $request){
        $data = new Place();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        $notification = array(
            'message'=>'New Place is Added successfully!!!',
            'alert-type'=>'success'
        );
        return redirect()->route('index')->with($notification);
    }
    public function DeletePlace($id){
        $deleteData = WorkRecord::where('placeid',$id)->delete();
        $data = Place::find($id);
        $data->delete();
        $notification = array(
            'message' => 'The Place Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('index')-> with($notification);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkRecord;
use App\Models\Place;

class WorkRecordController extends Controller
{
    //
    public function ViewRecord(){
        $data['recordData'] = WorkRecord::all();
        $data['placeData'] = Place::all();
        return view('workrecord', $data);
    }


    public function CreateRecord(Request $request){
        $data = new WorkRecord();
        $data->date = $request->date;
        $data->placeid = $request->placeid;
        $data->duration = $request->duration;
        $data->distance = $request->distance;
        $data->description = $request->description;
        $data->save();
        $notification = array(
            'message'=>'New Record is Added successfully!!!',
            'alert-type'=>'success'
        );
        return redirect()->route('viewrecord')->with($notification);
    }
    public function EditRecord(Request $request, $id){
        $data =  WorkRecord::find($id);
        $data->date = $request->date;
        $data->placeid = $request->placeid;
        $data->duration = $request->duration;
        $data->distance = $request->distance;
        $data->description = $request->description;
        $data->save();
        $notification = array(
            'message'=>'New Record updated successfully!!!',
            'alert-type'=>'success'
        );
        return redirect()->route('viewrecord')->with($notification);
    }
    public function DeleteRecord($id){
        $data = WorkRecord::find($id);
        $data->delete();
        $notification = array(
            'message' => 'The Record Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('viewrecord')-> with($notification);
    }
    public function FilterWork(Request $request){
        // check if from date is less than to date
        $fromDate = $request->fromdate;
        $toDate = $request->todate;
        $placeid = $request->placeid;
        $data['placeData'] = Place::all();
        $data['fromDate'] = $request->fromdate;
        $data['toDate'] = $request->todate;
        $data['placeid'] = $request->placeid;
        if($fromDate > $toDate){
            $notification = array(
                'message' => 'From date can not be greater than to date!',
                'alert-type' => 'error'
            );
            return redirect()->route('viewrecord')-> with($notification);
        }
        else {
            if(($request->fromdate != NUll and $request->todate != NULL) and $request->placeid !=NULL){

                $data['recordData'] = WorkRecord::whereDate('date','>=',$fromDate)->whereDate('date','<=', $toDate)->where('placeid', $placeid)->get();
                return view('workrecord', $data);
            }
            else if(($request->fromdate != NUll and $request->todate != NULL) and $request->placeid == NULL){
                $data['placeData'] = Place::all();
                $data['recordData'] = WorkRecord::whereDate('date','>=',$fromDate)->whereDate('date','<=', $toDate)->get();
                return view('workrecord', $data);
            }
            else if(($request->fromdate == NUll and $request->todate == NULL) and $request->placeid !=NULL){
                $data['placeData'] = Place::all();
                $data['recordData'] = WorkRecord::where('placeid', $placeid)->get();
                return view('workrecord', $data);
            }
            else {
                $notification = array(
                    'message' => 'Please apply filter between two dates or places!',
                    'alert-type' => 'error'
                );
                return redirect()->route('viewrecord')-> with($notification);
            }

        }


    }
}

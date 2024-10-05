<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use App\Models\WorkRecord;
use App\Models\Place;

class ReportController extends Controller
{
     //Function to view my dashboard
     public function ViewReport(){
        $data['todayDate'] = Carbon::today()->format('Y-m-d');
        $data['day'] = Carbon::today()->format('d l');
        $data['month'] = Carbon::today()->format('F');
        $monthNames = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];
        $monthNumber = 0;
        foreach($monthNames as $key=>$value){
            if($key ==  $data['month']){
                $monthNumber = $value;
            }
        }
        // dd($monthNumber);

        $data['thisMonthData'] = WorkRecord::whereMonth('date', $monthNumber)->get();
        // Get the income for this year in each month
        $data['totalYearlyWork'] = array();
        for($i=1; $i<=12; $i++){
            $data['totalYearlyWork'][$i]= WorkRecord::whereMonth('date', $i)
                            ->sum('id');
        }
        $data['totalYearlyWorkDuration'] = array();
        for($i=1; $i<=12; $i++){
            $data['totalYearlyWorkDuration'][$i]= WorkRecord::whereMonth('date', $i)
                            ->sum('duration');
        }
        $data['totalYearlyWorkDistance'] = array();
        for($i=1; $i<=12; $i++){
            $data['totalYearlyWorkDistance'][$i]= WorkRecord::whereMonth('date', $i)
                            ->sum('distance');
        }
        $placeInfo = WorkRecord::groupBy('placeid')
                                ->selectRaw('count(id) as count, placeid')
                                ->orderBy('count', 'DESC')
                                ->limit(5)
                                ->get('placeid');
        $data['topFivePlaceCount'] = array();
        $data['topFivePlaceName'] = array();
        foreach($placeInfo as $key=>$place){
            $data['topFivePlaceCount'][$key] = WorkRecord::where('placeid',$place->placeid)
                                            ->count('id');
            // $data['topFiveIncomeTypes'][$key] = IncomeType::where('id',$income->incometypeid)->value('name');
            $data['topFivePlaceName'][$key] = Place::where('id',$place->placeid)->value('name');
        }
        return view('report', $data);
    }

}

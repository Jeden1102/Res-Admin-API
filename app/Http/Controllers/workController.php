<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\work_time;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\order;

class workController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            return work_time::create($request->all());
        }catch(Exception $err){
            return $err;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return work_time::where('waiter_id',$id)->orderBy('id','desc')->first();
        }catch(Exception $err){
            return $err;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            // $flight->end_time = "16:47:33.000000";
            // $flight->end_day = '2022-03-09';
            $flight = work_time::where('waiter_id', $id)
      ->where('end_time', null)
      ->first();
                  $flight->end_time = $request->end_time;
            $flight->end_day = $request->end_day;
            $flight->hours_worked = $request->hours_worked;
            $flight->save();

            return $flight;
        // return $user;
        }catch(Exception $err){
            return $err;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function sumHoursWorked($id){
        try{
            $data = work_time::select(
                'hours_worked',
                )->where('waiter_id',$id)->get();
            //total hours    
            $totalHours = $this->sumHours($data);
            //total orders
            $total_orders  = order::select(
            DB::raw("(count(*)) as total_orders"),
            )->where('waiter_id',$id)->get();
            //BY DATE
            $worked_year_month = work_time::select(
                "id" ,
                DB::raw("SUM(hours_worked) as hours_worked"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();
                $worked_year = work_time::select(
                    "id" ,
                    DB::raw("SUM(hours_worked) as hours_worked"),
                    DB::raw("(DATE_FORMAT(created_at, '%Y')) as month_year")
                    )
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%%-%Y')"))
                    ->get();
        
            $lastWeek = work_time::select(
            "id" ,
            DB::raw("SUM(hours_worked) as hours_worked"),
            DB::raw("Date(created_at) as data")
            )
            ->whereBetween('created_at', 
                [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()])
            ->orderBy('created_at')
            ->groupBy(DB::raw('Date(created_at)'))
            ->get(); 
        }catch(Exception $err){
            return $err;
        }
    
       return [
           'sumWorked'=>$totalHours,
           'totalOrders'=>$total_orders,
           'worked_year_month'=>$worked_year_month,
           'worked_year'=>$worked_year,
           'lastWeek'=>$lastWeek,
       ];
    }

    public function sumHours($arr){
        $sum = strtotime('00:00:00');
        $totaltime = 0;
        foreach($arr as $element ) {
            if($element->hours_worked != ""){
            $timeinsec = strtotime($element->hours_worked) - $sum;
            $totaltime = $totaltime + $timeinsec;
            }
        }
        $h = intval($totaltime / 3600);
        $totaltime = $totaltime - ($h * 3600);
        $m = intval($totaltime / 60);
        $s = $totaltime - ($m * 60);
        return "$h:$m:$s";
    }
}

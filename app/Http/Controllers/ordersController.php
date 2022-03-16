<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\order;
use Exception;
class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return order::all();
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
        order::create($request->all());
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
        return order::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return order::destroy($id);
    }
    public function getTipsData($id){
        return order::where("waiter_id",$id)->get();
    }
    public function getTipsByDate($id){
        try{
            $tipsByMonthYear = order::select(
                "id" ,
                DB::raw("(sum(tip)) as total_tips"),
                DB::raw("(count(*)) as total_orders"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();
    
            $tipsByYear = order::select(
                    "id" ,
                    DB::raw("(sum(tip)) as total_tips"),
                    DB::raw("(count(*)) as total_orders"),
                    DB::raw("(DATE_FORMAT(created_at, '%Y')) as month_year")
                    )
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%%-%Y')"))
                    ->get();
    
            $lastWeek = order::select(
            "id" ,
            DB::raw("(sum(tip)) as total_tips"),
            DB::raw("(count(*)) as total_orders"),
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
                'tipsByMonthYear'=>$tipsByMonthYear,
                'tipsByYear'=>$tipsByYear,
                'lastWeek'=>$lastWeek,
            ];
    }
}

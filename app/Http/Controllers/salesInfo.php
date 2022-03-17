<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\order;
use Exception;
class salesInfo extends Controller
{
    /*
WYKRESY:

PIE :
- podział klientow ze względu na msc/dni tygodnai
    */
    public function ordersInfo(){
        //ciekawostki
        $orderCounts = order::all()->count();
        $sumPrice = order::all()->sum('sum_price');
        $avgOrderPrice = $sumPrice/$orderCounts;
        $maxOrderPrice = order::all()->max('sum_price');
        //wykresy
        $orderByMonthYear = order::select(
            "id" ,
            DB::raw("(count(*)) as total_orders"),
            DB::raw("(sum(sum_price)) as total_income"),
            DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as data")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->get();
        $orderByYear = order::select(
                "id" ,
                DB::raw("(count(*)) as total_orders"),
                DB::raw("(sum(sum_price)) as total_income"),
                DB::raw("(DATE_FORMAT(created_at, '%Y')) as data")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%%-%Y')"))
                ->get();

        $orderLastWeek = order::select(
        "id" ,
        DB::raw("(count(*)) as total_orders"),
        DB::raw("(sum(sum_price)) as total_income"),
        DB::raw("Date(created_at) as data")
        )
        ->whereBetween('created_at', 
            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()])
        ->orderBy('created_at')
        ->groupBy(DB::raw('Date(created_at)'))
        ->get();  

        return [
            'orderCount'=>$orderCounts,
            'sumPrice'=>$sumPrice,
            'avgOrderPrice'=>$avgOrderPrice,
            'maxOrderPrice'=>$maxOrderPrice,
            'orderByMonthYear'=>$orderByMonthYear,
            'orderByYear'=>$orderByYear,
            'orderLastWeek'=>$orderLastWeek,
        ];
    }
}

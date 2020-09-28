<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\DailyUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyUsageController extends Controller
{
    public function index(Request $request){
        $daily_usage=DailyUsage::orderBy('id','asc')
            ->whereDate('date',Carbon::today())
            ->paginate(5);
        if($daily_usage->isEmpty()){
            $latest_date=DailyUsage::max('date');
            $daily_usage=DailyUsage::orderBy('id','asc')
                ->whereDate('date',$latest_date)
                ->paginate(5);
//            dd($daily_usage);
        }
        $now=Carbon::now();
        $days=$this->getDays($now);
        $years=$this->getYears();
        $usage=$this->getDailyUsage($now);
        $count_of_day=Carbon::now()->daysInMonth;
        $in=0;
        $out=0;
        foreach(DailyUsage::all() as $key=>$ds){
            if($ds->status=="In"){
//                dd($ds);
                $in+=$ds->amount;
            }elseif($ds->status=="Out"){
                $out+=$ds->amount;
            }
        }
        $remain=$in-$out;
        if($request->ajax()){
            if($daily_usage->isNotEmpty()){
                return view('DailyUsage.filter_daily_usage',compact('daily_usage'));
            }
            else{
                return "<p style='padding:100px;font-size: 25px;color:red'>Request Data is Empty.Try Again!</p>";
            }
        }
        $average=$out/$count_of_day;

        return view('DailyUsage.index',compact('daily_usage','remain','in','out','days','usage','average','years'));
    }
    public function create(){
        return view('DailyUsage.create');
    }
    public function store(Request $request){
        DailyUsage::create([
            'title'=>$request->title,
            'date'=>$request->date,
            'status'=>$request->status,
            'amount'=>$request->amount,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect('/daily_usage');
    }
    public function filter_usage(Request  $request){
//        dd($request->all());
        $daily_usage=DailyUsage::whereDate('date','>=',$request->from_date)
            ->whereDate('date','<=',$request->to_date)->paginate(5);
//        dd($daily_usage);
        if($daily_usage->isNotEmpty()){
            return view('DailyUsage.filter_daily_usage',compact('daily_usage'));
        }else{
            return "<p style='padding:100px;font-size: 25px;color:red'>Request Data is Empty.Try Again!</p>";
        }
    }
    public function filterMonthly(Request  $request){
        $date= Carbon::parse($request->yearly . '-' . $request->monthly);
        $days=$this->getDays($date);
//        $years=$this->getYears();
        $usage=$this->getDailyUsage($date);
//        $count_of_day=Carbon::now()->daysInMonth;
        $in=0;
        $out=0;
        foreach(DailyUsage::all() as $key=>$ds){
            if($ds->status=="In"){
//                dd($ds);
                $in+=$ds->amount;
            }elseif($ds->status=="Out"){
                $out+=$ds->amount;
            }
        }
        $remain=$in-$out;
        return response()->json([
            'remain'=>$remain,
            'in'=>$in,
            'out'=>$out,
            'days'=>$days,
            'daily_usage'=>$usage,
        ]);
//        return view('DailyUsage.index',compact('daily_usage','remain','in','out','days','usage','average','years'));

//        for($i=1;$i<=$noOfdays;$i++){
//            $date = Carbon::parse($request->yearly . '-' . $request->monthly . '-' . $i);
//            $usage=DailyUsage::whereDate('date',$date);
//        }
    }
    public function getDays($month){
        $noOfdays=$month->daysInMonth;
        $days=[];
        for ($i = 1; $i <= $noOfdays; $i++) {
            array_push($days,$i);
        }
        return $days;
//        dd($days);
    }
    public function getYears(){
        $date=DailyUsage::min('date');
        $d=new Carbon($date);
        $min_year=(int)$d->format('Y');
        $current_year=Carbon::now()->year;
        $years=[];
        for($i=$min_year;$i<=$current_year;$i++){
            array_push($years,$i);
        }
        return $years;
    }
    public function getDailyUsage($current){
//        $current = Carbon::now();
        $c_month = $current->month;
//        dd($c_month);
        $c_year = $current->year;
        $dayInMonth = Carbon::now()->daysInMonth;
        $usage=[];
        for ($i = 1; $i <= $dayInMonth; $i++) {
            $date = Carbon::parse($c_year . '-' . $c_month . '-' . $i);
            $d=DailyUsage::whereDate('date',$date)->groupBy('date')->where('status','out')->sum('amount');
            array_push($usage,(int)$d);
        }
//        dd($usage);
        return $usage;
//        dd($usage);
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\User;
use PDF;
use DB;

class VoteController extends Controller
{
    function index(){
        $data = DB::table('votes')->select(
            DB::raw('name as name'),
            DB::raw('count(*) as number'))->groupBy('name')->get();

        $array[]=['name','number'];
        
        foreach($data as $key => $value){
            $array[++$key] = [$value -> name,$value -> number];
        }

        $vote = json_encode($array);

        // $user = User::find(1);
        // $view =\View::make('user.pdf',compact('user'));
        // $html = $view ->render();
        
        // $pdf = new PDF();
        // $pdf::setTitle('รายงานผลการตรวจสุขภาพ');
        // $pdf::AddPage();
        // $pdf::SetFont('freeserif');
        // $pdf::WriteHTML($html,true,false,true,false);
        // $pdf::Output('report.pdf');

        return view('vote',compact('vote'));
    }

    function show(Request $request){
        if($request->ajax()){
            $result = $request->get('language');
            $vote = new Vote;
            $vote->name=$result;
            $vote->save();
        }
        $data = DB::table('votes')->select(
            DB::raw('name as name'),
            DB::raw('count(*) as number'))->groupBy('name')->get();
        $array[]=['name','number'];

        foreach($data as $key => $value){
            $array[++$key] = [$value -> name,$value -> number];
        }

        echo json_encode($array);
    }

    
}

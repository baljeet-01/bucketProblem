<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BucketController extends Controller
{
    //
    function index(){
        return view('bucket');
    }

    function bucketCalculation(Request $request){

        if($request->session()->has('empty_space')){
            $bucket_arr = session('empty_space');
        }
        else {
            $bucket_arr = [
                'a' => $request->bucketA, 
                'b' => $request->bucketB, 
                'c' => $request->bucketC, 
                'd' => $request->bucketD, 
                'e' => $request->bucketE
            ];    
        }

        arsort($bucket_arr);

         if($request->session()->has('ball_vol_arr')){
            $ball_vol_arr = session('ball_vol_arr');
        }
        else {
            $ball_vol_arr = [
                'pink' => $request->pink, 
                'red' => $request->red, 
                'blue' => $request->blue, 
                'orange' => $request->orange, 
                'green' => $request->green
            ];

        }


        if($request->session()->has('ball_arr')){
            $ball_arr = session('ball_arr');
        }
        else {
            $ball_arr = [
                'pink'=> $request->npink, 
                'red' => $request->nred, 
                'blue'=>$request->nblue, 
                'orange'=>$request->norange, 
                'green'=>$request->ngreen
            ];
        }
        arsort($ball_arr);

        $pending_balls = $ball_arr;
        $empty_space = $bucket_arr;

        $bucket_ball_map = [];

        foreach($bucket_arr as $bucket_name=>$bucket_volume){   
            foreach($ball_arr as $ball_color=>$ball_number){           
                if($empty_space[$bucket_name] > 0 && $pending_balls[$ball_color] > 0){
                    if(!isset($bucket_ball_map[$bucket_name][$ball_color])) {
                        $bucket_ball_map[$bucket_name][$ball_color] = 0;
                    }
                    $stagging_calculation = $empty_space[$bucket_name] - ($pending_balls[$ball_color] * $ball_vol_arr[$ball_color]);
                    if($stagging_calculation >= 0) {
                        $empty_space[$bucket_name] = $stagging_calculation;
                        $bucket_ball_map[$bucket_name][$ball_color] = $bucket_ball_map[$bucket_name][$ball_color] + $pending_balls[$ball_color];
                        $pending_balls[$ball_color] = 0;
                    }
                    else {
                        if($ball_vol_arr[$ball_color] <= $empty_space[$bucket_name]) {
                            $maximum_balls_of_color = (int)floor($empty_space[$bucket_name] / $ball_vol_arr[$ball_color]);
                            $stagging_calculation = $empty_space[$bucket_name] - ($maximum_balls_of_color * $ball_vol_arr[$ball_color]);
                            $empty_space[$bucket_name] = $stagging_calculation;
                            $pending_balls[$ball_color] = $pending_balls[$ball_color] - $maximum_balls_of_color;
                            $bucket_ball_map[$bucket_name][$ball_color] = $bucket_ball_map[$bucket_name][$ball_color] + $maximum_balls_of_color;
                        }
                    }
                }
            }       
        }

        session(['empty_space' => $empty_space]);
        session(['ball_vol_arr' => $ball_vol_arr]);
        session(['ball_arr' => $ball_arr]);

        $output = [];
        
        $filled_space = 0;
        foreach($bucket_ball_map as $name => $value) {
            foreach($value as $color => $count) {
                if(!isset($output[$name])) {
                    $output[$name] = 'This Bucket has '.$count." ".$color." ball";
                } 
                else {
                    $output[$name] = $output[$name].' and '.$count." ".$color." ball";
                }
                $filled_space = $filled_space + ($count * $ball_vol_arr[$color]);
            }
        }

        $left_out_ball_volume = 0;
        foreach($pending_balls as $color => $count) {
            $left_out_ball_volume = $left_out_ball_volume + ($count * $ball_vol_arr[$color]);
        }
        return view('bucket', ['output'=>$output, 'left_out_ball_volume'=>$left_out_ball_volume, 'filled_space'=>$filled_space]);
    }

    function destorySession(){
        session()->flush();
        return redirect('/');
    }
}

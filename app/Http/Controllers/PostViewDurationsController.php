<?php

namespace App\Http\Controllers;

use App\Models\PostViewDuration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostViewDurationsController extends Controller
{
    public function trackduration(Request $request){

        // need to convert laravel timing format for to get time diff
        // $entrytime = Session::get('entrytime'); // entrytime: "2024-06-08T13:15:14.926495Z"
        // $exittime = $request->input('exittime'); // exittime: "2024-06-08T13:15:14.879Z"

        $entrytime = Carbon::parse(Session::get('entrytime')); // entrytime: "2024-06-08T13:23:50.072521Z"
        $exittime = Carbon::parse($request->input('exittime')); // exittime: "2024-06-08T13:23:49.686000Z"
        $postid = Session::get('post_id')->id;
        $user_id = Auth::id();


        if($entrytime && $exittime && $postid && $user_id){

            $durationinseconds = $entrytime->diffInSeconds($exittime);  //  $entrytime->diffInMinutes($exittime);

            $postviewduration = new PostViewDuration();
            $postviewduration->user_id = $user_id;
            $postviewduration->post_id = $postid;
            $postviewduration->duration = $durationinseconds;
            $postviewduration->save();

            // Clear Session Variables
            Session::forget('entrytime');
            Session::forget('post_id');

        }


        return response()->json(['status'=>'success','entrytime'=>$entrytime,'exittime'=>$exittime,'postid'=>$postid]); //,'duration'=>$durationinseconds
        // return response()->json(['status'=>'success']);
    }
}

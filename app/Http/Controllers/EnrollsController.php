<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Stage;
use App\Models\Status;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EnrollsController extends Controller
{
    public function index()
    {
        $enrolls = Enroll::orderBy('updated_at','desc')->get();
        $stages = Stage::whereIn('id',[1,2,3])->get();
        return view('enrolls.index',compact('enrolls','stages'));
    }


    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('enrolls.create',compact('statuses'));
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'image'=>'image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $enroll = new Enroll();
        $enroll->post_id = $request['post_id'];
        $enroll->remark = $request['remark'];
        $enroll->user_id = $user_id;

        if(file_exists($request['image'])){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$enroll['id'].$fname;
            $file->move(public_path('assets/img/enrolls/'), $imagenewname);

            $filepath = 'assets/img/enrolls/'.$imagenewname;
            $enroll->image = $filepath;
        }

        $enroll->save();
        return redirect()->back();
    }

    public function show(string $id)
    {
        $enroll = Enroll::findOrfail($id);
        return view('enrolls.show',["enroll"=>$enroll]);
    }


    public function edit(string $id)
    {
        $enroll = Enroll::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('enrolls.edit')->with('enroll',$enroll)->with('statuses',$statuses);
    }

    public function update(Request $request, string $id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        try{


        $enroll = Enroll::findOrFail($id);
        $enroll->stage_id = $request['editstage_id'];
        $enroll->remark = $request['editremark'];
        $enroll->user_id = $user_id;

        $enroll->save();

        if($enroll){
            return response()->json(['status'=>'success','data'=>$enroll]);
        }

        return response()->json(['status'=>'failed','message'=>'Failed to Update']);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }


    public function destroy(string $id)
    {
        $enroll = Enroll::findOrFail($id);

        // Remove Old Image

        $path = $enroll->image;

        if(File::exists($path)){
            File::delete($path);
        }

        $enroll->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequest;
use App\Models\Day;
use App\Models\Dayable;
use App\Models\Leave;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;
use App\Notifications\LeaveNotify;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class LeavesController extends Controller
{

     public function index()
    {
        $leaves = Leave::all();


        return view('leaves.index',compact('leaves'));
    }


    public function create()
    {
        $data['posts'] = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $data['tags'] = User::orderBy('name','asc')->get()->pluck('name','id');
        $data['gettoday'] = Carbon::today()->format('Y-m-d');
        return view('leaves.create',$data);
    }


    public function store(LeaveRequest $request)
    {

        // $this->validate($request,[
        //     'post_id'=>'required',
        //     'starttime'=>'required',
        //     'endtime'=>'required',
        //     'tag'=>'require',
        //     'title'=>'required|max:50',
        //     'content'=>'required',
        //     'image'=>'nullable|image|mimes:png,jpg,jpeg|max:1024'
        // ]);

        $user = Auth::user();
        $user_id = $user->id;

        $leave = new Leave();
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];

        $leave->user_id = $user_id;

        // Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$leave['id'].$fname;
            $file->move(public_path('assets/img/leaves/'), $imagenewname);
            $filepath = 'assets/img/leaves/'.$imagenewname;

            $leave->image = $filepath;
        }

        $leave->save();

        session()->flash('success','New Leave Created');

        // $user = User::all();
        $tagperson = $leave->tagperson()->get();
        // dd($tagperson);
        $studentid = $leave->student($user_id);
        Notification::send($tagperson,new LeaveNotify($leave->id,$leave->title,$studentid));
        return redirect(route('leaves.index'));
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $type = "App\Notifications\AnnouncementNotify";
        $leave = Leave::findOrfail($id);

        $getnoti = \DB::table('notifications')->where('notifiable_id',$user_id,$id)->where('type',$type)->where('data->id',$id)->pluck('id');
        // dd($getnoti);
        \DB::table('notifications')->where('id',$getnoti)->update(['read_at'=>now()]);
        return view('leaves.show',["leave"=>$leave]);
    }


    public function edit(string $id)
    {

        $data['leave'] = Leave::findOrFail($id);
        // dd($leave);
        $data['posts'] = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get()->pluck('name','id');
        return view('leaves.edit',$data);
    }

    public function update(LeaveRequest $request, string $id)
    {
        // $this->validate($request,[
        //     'post_id'=>'required',
        //     'starttime'=>'required',
        //     'endtime'=>'required',
        //     'tag'=>'require',
        //     'title'=>'required|max:50',
        //     'content'=>'required',
        //     'image'=>'nullable|image|mimes:png,jpg,jpeg|max:1024'
        // ]);

        $user = Auth::user();

        $leave = Leave::findOrFail($id);
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];

        // Remove Old Image

        if($request->hasFile('image')){
            $path = $leave->image;

            if(File::exists($path)){
                File::delete($path);
            }
        }

        if($request->hasFile('image')){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$leave['id'].$fname;
            $file->move(public_path('assets/img/leaves/'), $imagenewname);
            $filepath = 'assets/img/leaves/'.$imagenewname;

            $leave->image = $filepath;
        }


        $leave->save();
        session()->flash('success','Update Successfully');
        return redirect(route('leaves.index'));
    }


    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);

        // Remove Old Image

        $path = $leave->image;

        if(File::exists($path)){
            File::delete($path);
        }

        $leave->delete();
        return redirect()->back();
    }

}

// 31 jan

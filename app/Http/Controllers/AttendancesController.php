<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttendancesController extends Controller
{
    public function index()
    {
        $attendances = Attendance::orderBy('updated_at','desc')->get();
        // $posts = Post::where('attshow',3)->get();
        $posts = DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get(); //beware $post->['id'] :: must be call by object in view file
        return view('attendances.index',compact('attendances','posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'classdate'=>'required|date',
            'post_id'=>'required',
            'attcode'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $attendance = new Attendance();
        $attendance->classdate = $request['classdate'];
        $attendance->post_id = $request['post_id'];
        $attendance->attcode = Str::upper($request['attcode']);
        $attendance->user_id = $user_id;

        $attendance->save();

        session()->flash('success','Att Created');
        return redirect(route('attendances.index'));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:attendances,name,'.$id],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $attendance = Attendance::findOrFail($id);
        $attendance->name = $request['name'];
        $attendance->slug = Str::slug($request['name']);
        $attendance->status_id = $request['status_id'];

        $attendance->save();
        return redirect(route('attendances.index'));
    }

}

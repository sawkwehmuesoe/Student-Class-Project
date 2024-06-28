<?php

namespace App\Http\Controllers;

use App\Models\Attendcodegenerators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttcodegeneratorsController extends Controller
{
    public function index()
    {
        $attcodegenerators = Attendcodegenerators::orderBy('updated_at','desc')->get();
        // $posts = Post::where('attshow',3)->get();
        $posts = DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get(); //beware $post->['id'] :: must be call by object in view file
        return view('attcodegenerators.index',compact('attcodegenerators','posts'));
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

        $attcodegenerator = new Attendcodegenerators();
        $attcodegenerator->classdate = $request['classdate'];
        $attcodegenerator->post_id = $request['post_id'];
        $attcodegenerator->attcode = Str::upper($request['attcode']);
        $attcodegenerator->status_id = $request['status_id'];
        $attcodegenerator->user_id = $user_id;

        $attcodegenerator->save();

        session()->flash('success','Att Created');
        return redirect(route('attcodegenerators.index'));
    }

}

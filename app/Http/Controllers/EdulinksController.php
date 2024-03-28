<?php

namespace App\Http\Controllers;

use App\Models\Edulink;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EdulinksController extends Controller
{
    public function index()
    {
        $data['edulinks'] = Edulink::orderBy('updated_at','desc')->paginate(5);
        $data['posts'] = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->pluck('title','id'); //beware $post->['id'] :: must be call by object in view file
        return view('edulinks.index',$data);
    }


    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('edulinks.create',compact('statuses'));
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'classdate' => 'required|date',
            'post_id'=>'required',
            'url'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $edulink = new Edulink();
        $edulink->classdate = $request['classdate'];
        $edulink->post_id = $request['post_id'];
        $edulink->url = $request['url'];
        $edulink->user_id = $user_id;

        $edulink->save();
        return redirect(route('edulinks.index'));
    }

    public function show(string $id)
    {
        $edulink = edulink::findOrfail($id);
        return view('edulinks.show',["edulink"=>$edulink]);
    }


    public function edit(string $id)
    {
        $edulink = edulink::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('edulinks.edit')->with('edulink',$edulink)->with('statuses',$statuses);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:edulinks,name,'.$id],
            'image'=>['image','mimes:png,jpg,jpeg','max:1024'],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $edulink = Edulink::findOrFail($id);
        $edulink->name = $request['name'];
        $edulink->slug = Str::slug($request['name']);
        $edulink->status_id = $request['status_id'];
        $edulink->user_id = $user_id;

        $edulink->save();
        return redirect(route('edulinks.index'));
    }


    public function destroy(string $id)
    {
        $edulink = edulink::findOrFail($id);

        $edulink->delete();
        return redirect()->back();
    }
}

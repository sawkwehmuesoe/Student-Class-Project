<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RelativesCotroller extends Controller
{
    public function index()
    {
        $relatives = Relative::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.index',compact('relatives','statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:50|unique:relatives',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $relative = new Relative();
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;

        $relative->save();

        session()->flash('success','New Relative Created');
        return redirect(route('relatives.index'));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:relatives,name,'.$id],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $relative = Relative::findOrFail($id);
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;

        $relative->save();
        session()->flash('success','Update Successfully');
        return redirect(route('relatives.index'));
    }


    public function destroy(string $id)
    {
        $relative = Relative::findOrFail($id);
        $relative->delete();
        session()->flash('info','Delete Successfully');
        return redirect()->back();
    }
}

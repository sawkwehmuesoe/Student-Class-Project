<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCreateRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusCreateRequest $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $status = new Status();
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;

        $status->save();
        return redirect(route('statuses.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $status = Status::findOrFail($id);
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;

        $status->save();
        return redirect(route('statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Status::findOrFail($id);
        $student->delete();
        return redirect()->back();
    }
}

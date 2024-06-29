<?php

namespace App\Http\Controllers;

use App\Models\Socialapplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Response;

class SocialapplicationsController extends Controller
{
    public function index()
    {
        $socialapplications = Socialapplication::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('socialapplications.index',compact('socialapplications','statuses'));
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'=>'required|max:50|unique:socialapplications',
        //     'status_id'=>'required|in:3,4'
        // ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{

            $socialapplication = new Socialapplication();
            $socialapplication->name = $request['name'];
            $socialapplication->slug = Str::slug($request['name']);
            $socialapplication->status_id = $request['status_id'];
            $socialapplication->user_id = $user_id;

            $socialapplication->save();

            if($socialapplication){
                return response()->json(['status'=>'success','data'=>$socialapplication]);
            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }


    }

    public function edit(string $id){

        $socialapplication = Socialapplication::findOrFail($id);

        return response()->json($socialapplication);

    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:socialapplications,name,'.$id],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;


        try{
            $socialapplication = Socialapplication::findOrFail($id);
            $socialapplication->name = $request['name'];
            $socialapplication->slug = Str::slug($request['name']);
            $socialapplication->status_id = $request['status_id'];
            $socialapplication->user_id = $user_id;

            $socialapplication->save();

            if($socialapplication){
                return response()->json(['status'=>'success','data'=>$socialapplication]);
            }

            return response()->json(['status'=>'failed','message'=>'Failed to update Payment Method']);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }

    public function destroy(string $id)
    {

        try{

            $socialapplication = Socialapplication::where("id",$id)->delete();
            return Response::json($socialapplication);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }

    public function typestatus(Request $request)
    {
        $socialapplication = Socialapplication::findOrFail($request['id']);
        $socialapplication->status_id = $request['status_id'];
        $socialapplication->save();

        return response()->json(["success"=>"Status Change Successfully"]);
    }

    public function fetchalldatas()
    {
        try{
            $socialapplications = Socialapplication::all();
            return response()->json(["status"=>"status","data"=>$socialapplications]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }
}

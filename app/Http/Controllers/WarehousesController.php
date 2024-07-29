<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::paginate(5);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('warehouses.index',compact('warehouses','statuses'));
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'=>'required|max:50|unique:warehouses',
        //     'status_id'=>'required|in:3,4'
        // ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{

            $warehouse = new Warehouse();
            $warehouse->name = $request['name'];
            $warehouse->slug = Str::slug($request['name']);
            $warehouse->status_id = $request['status_id'];
            $warehouse->user_id = $user_id;

            $warehouse->save();

            if($warehouse){
                return response()->json(['status'=>'success','data'=>$warehouse]);
            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }


    }

    public function edit(string $id){

        $warehouse = Warehouse::findOrFail($id);

        return response()->json($warehouse);

    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:warehouses,name,'.$id],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;


        try{
            $warehouse = Warehouse::findOrFail($id);
            $warehouse->name = $request['name'];
            $warehouse->slug = Str::slug($request['name']);
            $warehouse->status_id = $request['status_id'];
            $warehouse->user_id = $user_id;

            $warehouse->save();

            if($warehouse){
                return response()->json(['status'=>'success','data'=>$warehouse]);
            }

            return response()->json(['status'=>'failed','message'=>'Failed to update Payment Method']);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }

    public function fetchalldatas()
    {
        try{
            $warehouses = Warehouse::all();
            return response()->json(["status"=>"status","data"=>$warehouses]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }
}

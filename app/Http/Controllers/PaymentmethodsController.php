<?php

namespace App\Http\Controllers;

use App\Models\Paymentmethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Status;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentmethodsController extends Controller
{
    public function index()
    {
        $paymentmethods = Paymentmethod::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('paymentmethods.index',compact('paymentmethods','statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:50|unique:paymentmethods',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{

            $paymentmethod = new Paymentmethod();
            $paymentmethod->name = $request['name'];
            $paymentmethod->slug = Str::slug($request['name']);
            $paymentmethod->status_id = $request['status_id'];
            $paymentmethod->user_id = $user_id;

            $paymentmethod->save();

            if($paymentmethod){
                return response()->json(['status'=>'success','data'=>$paymentmethod]);
            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }


    }


    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>['required','max:50','unique:paymentmethods,name,'.$id],
            'status_id'=>['required','in:3,4']
        ]);

        $user = Auth::user();
        $user_id = $user->id;


        try{
            $paymentmethod = Paymentmethod::findOrFail($id);
            $paymentmethod->name = $request['name'];
            $paymentmethod->slug = Str::slug($request['name']);
            $paymentmethod->status_id = $request['status_id'];
            $paymentmethod->user_id = $user_id;

            $paymentmethod->save();

            if($paymentmethod){
                return response()->json(['status'=>'success','data'=>$paymentmethod]);
            }

            return response()->json(['status'=>'failed','message'=>'Failed to update Payment Method']);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }


    // public function destroy(string $id)
    // {
    //     $paymentmethod = Paymentmethod::findOrFail($id);
    //     $paymentmethod->delete();

    //     session()->flash('info','Delete Successfully');
    //     return redirect()->back();
    // }

    public function destroy(Paymentmethod $paymentmethod)
    {

        try{

            if($paymentmethod){
                $paymentmethod->delete();
                return response()->json(["status"=>"success","data"=>$paymentmethod,"message"=>"Delete Successfully"]);
            }

            return response()->json(["status"=>"failed","message"=>"No Data Found"]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }

    public function typestatus(Request $request)
    {
        $paymentmethod = Paymentmethod::findOrFail($request['id']);
        $paymentmethod->status_id = $request['status_id'];
        $paymentmethod->save();

        return response()->json(["success"=>"Status Change Successfully"]);
    }
}

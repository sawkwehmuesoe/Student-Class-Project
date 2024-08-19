<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $packages = Package::all();
            return view('packages.list',compact('packages'))->render();
        }

        return view('packages.index');

    }


    public function store(Request $request){

        $request->validate([
            'name'=>'required|string|max:100',
            'price'=>'required|numeric',
            'duration'=>'required|integer'
        ]);

        Package::create($request->all());

        return response()->json(['message'=>'New Package Created'],201);

    }

    public function show($id){
        $package = Package::findOrFail($id);
        return response()->json($package);
    }


    public function update(Request $request,$id){
        $package = Package::findOrFail($id);
        $package->update($request->all());
        return response()->json(['message'=>'Update Successfully'],201);
    }

    public function destroy($id){
        Package::findOrFail($id)->delete();
        return response()->json(['message'=>'Delete Successfully'],201);
    }

    public function setpackage(Request $request){
        $request->validate([
            'setuser_id'=>'required|exists:users,id',
            'package_id'=>'required|exists:packages,id'
        ]);

        $user = User::find($request->input('setuser_id'));
        $package = Package::find($request->input('package_id'));

        if($user && $package){

            $user->package_id = $package->id;
            $user->subscription_expires_at = now()->addDays($package->duration);
            $user->save();

            return response()->json(['message'=>"Updated"],201);
        }

        return response()->json(['message'=>"Failed"],405);
    }
}

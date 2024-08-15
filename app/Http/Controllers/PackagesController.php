<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(){

        // if(request()->ajax()){
        //     $packages = Package::all();
        //     return view('packages.index',compact('packages'))->render();
        // }

        $packages = Package::all();
            return view('packages.index',compact('packages'))->render();

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
}

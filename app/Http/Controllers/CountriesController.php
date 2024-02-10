<?php

namespace App\Http\Controllers;

use App\Models\Country;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CountriesController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('countries.index',compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $country = new Country();
        $country->name = $request->name;
        $country->slug = Str::slug($request['name']);
        $country->user_id = $user_id;

        $country->save();
        return redirect(route('countries.index'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->slug = Str::slug($request['name']);
        $country->user_id = $user_id;

        $country->save();
        return redirect(route('countries.index'));
    }


    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect(route('countries.index'));
    }
}

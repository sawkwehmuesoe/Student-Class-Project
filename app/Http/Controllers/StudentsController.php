<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentsController extends Controller
{

    public function index()
    {
        $students = Student::all();

        return view('students.index',compact('students'));
    }

     public function create()
    {
        return view('students.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'regnumber'=>'required|unique:students,regnumber',
            'firstname'=>'required',
            'lastname'=>'required',
            'remark'=>'max:1000'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $student = new Student();
        $student->regnumber = $request['regnumber'];
        $student->firstname = $request['firstname'];
        $student->lastname = $request['lastname'];
        $student->slug = Str::slug($request['firstname']);
        $student->remark = $request['remark'];
        $student->user_id = $user_id;

        $student->save();
        return redirect(route('students.index'));
    }



    public function show(string $id)
    {
        $student = Student::findOrfail($id);

        return view('students.show',["student"=>$student]);
    }


    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit')->with("student",$student);
    }

      public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back();
    }
}

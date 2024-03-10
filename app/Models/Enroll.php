<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

    protected $table = "enrolls";
    protected $pprimaryKey = "id";
    protected $fillable = [
        'image',
        'post_id',
        'user_id',
        'stage_id',
        'remark'
    ];

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student(){
        // return $this->belongsTo(Student::class,'user_id');

        // Method 1
        // $students = Student::where('user_id',$userid)->get();
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }

        // Method 2
        // $students = Student::where('user_id',$userid)->get()->pluck('regnumber');
        // //   dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     return $student;
        // }

        //   Method 3
        // $students = Student::where('user_id',$this->user_id)->get();
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }

         // Method 4
         $students = Student::where('user_id',$this->user_id)->get()->pluck('regnumber');
         //   dd($students);
         foreach($students as $student){
             // dd($student);
             return $student;
         }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = "attendances";
    protected $primaryKEy = "id";
    protected $fillable =[
        'classdate',
        'post_id',
        'attcode',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function student($userid){
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
        $students = Student::where('user_id',$userid)->get()->pluck('regnumber');
        //   dd($students);
        foreach($students as $student){
            // dd($student);
            return $student;
        }
    }

    public function studenturl(){
        return Student::where('user_id',$this->user_id)->get(['students.id'])->first();
    }

    public function checkattcode($classdate,$postid,$attcode){

        $checkresult = \DB::table('attcodegenerators')->whereDate("classdate",$classdate)->where('post_id',$postid)->where("attcode",$attcode)->where('status_id',3)->exists();

        // dd($checkresult);
        return $checkresult;

    }

}

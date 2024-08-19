<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    protected $primaryKEy = "id";
    protected $fillable =[
        'regnumber',
        'firstname',
        'lastname',
        'slug',
        'remark',
        'status_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function enrolls(){
        return Enroll::where('user_id',$this['user_id'])->get();
    }

    // Method 1 (can duplicate regnumber)

    // protected static function boot(){

    //     parent::boot();

    //     static::creating(function($student){

    //         $lateststudent = \DB::table('students')->orderBy('id','desc')->first();
    //         $latestid = $lateststudent ? $lateststudent->id : 0;

    //         $student->regnumber = "WDF".str_pad($latestid+1,5,'0',STR_PAD_LEFT);

    //     });

    // }

    // Method 2 (solved  duplicated regnumber)

    protected static function boot(){

        parent::boot();

        static::creating(function($student){
            $student->regnumber = self::generatestudentid();

        });

    }

    protected static function generatestudentid(){
        return \DB::transaction(function(){
            $lateststudent = \DB::table('students')->orderBy('id','desc')->first();
            $latestid = $lateststudent ? $lateststudent->id : 0;
            $newstudentid= "WDF".str_pad($latestid+1,5,'0',STR_PAD_LEFT);

            // +1 again if the new student id is unique
            while(\DB::table('students')->where('regnumber',$newstudentid)->exists()){
                $latestid++;
                $newstudentid= "WDF".str_pad($latestid+1,5,'0',STR_PAD_LEFT);
            }

            return $newstudentid;
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edulink extends Model
{
    use HasFactory;

    protected $table = "edulinks";
    protected $primaryKEy = "id";
    protected $fillable =[
        'classdate',
        'post_id',
        'url',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    //Define Local Scope

    // public function scope[name]($query){
    //     return $query->[method];
    // }

    public function scopezaclassdate($query){
        return $query->orderBy('updated_at','desc');
    }

    // public function scopefilter($query){
    //     // search by class date
    //     if($getfilter = request('filter')){
    //         $query->where('post_id',$getfilter);
    //     }

    //     // search by class date / created at / updated at
    //     if($getsearch = request('search')){
    //         // $query->where('classdate','LIKE',"%".$getsearch."%");
    //         // $query->where('classdate','LIKE',"%${getsearch}%")
    //         //     ->orWhere('created_at','LIKE',"%${getsearch}%")
    //         //     ->orWhere('updated_at','LIKE',"%${getsearch}%");

    //         // search by class date / created at / updated at
    //         // $query->where('classdate','LIKE',"%${getsearch}%");
    //         // $query->orWhere('created_at','LIKE',"%${getsearch}%");
    //         // $query->orWhere ('updated_at','LIKE',"%${getsearch}%");

    //         // $query->where('classdate','LIKE',"%".$getsearch."%");
    //         $query->where('classdate','LIKE',"%${getsearch}%")
    //             ->orWhere('created_at','LIKE',"%${getsearch}%")
    //             ->orWhere('updated_at','LIKE',"%${getsearch}%")
    //             ->orWhereHas('post',function($query) use($getsearch){
    //                 $query->where('title','LIKE',"%${getsearch}%");
    //             });
    //     }

    //     return $query;
    // }

    public function scopefilteronly($query){
        // search by class date
        if($getfilter = request('filter')){
            $query->where('post_id',$getfilter);
        }

        return $query;
    }

    public function scopesearchonly($query){

        // search by class date / created at / updated at
        if($getsearch = request('search')){
            $query->where('classdate','LIKE',"%$getsearch%")
                ->orWhere('created_at','LIKE',"%$getsearch%")
                ->orWhere('updated_at','LIKE',"%$getsearch%")
                ->orWhereHas('post',function($query) use($getsearch){
                    $query->where('title','LIKE',"%$getsearch%");
                });
        }

        return $query;
    }
}

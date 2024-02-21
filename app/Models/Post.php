<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $primaryKEy = "id";
    protected $fillable =[
        'image',
        'title',
        'slug',
        'content',
        'fee',
        'startdate',
        'enddate',
        'starttime',
        'endtime',
        'type_id',
        'tag_id',
        'attshow',
        'status_id',
        'user_id'
    ];

    public function attstatus(){
                                    // related foreignKey
        // return $this->belongsTo(Status::class,'attshow');
                                    // related foreignKey , ownerkey
        return $this->belongsTo(Status::class,'attshow','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function type(){
                                // related
        // return $this->belongsTo(Type::class);
                                // related foreignKey
        // return $this->belongsTo(Type::class,'type_id');
                                //related foreignKey ownerKey
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function days(){
        return $this->morphToMany(Day::class,'dayable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendcodegenerators extends Model
{
    use HasFactory;

    protected $table = "attendcodegenerators";
    protected $primaryKEy = "id";
    protected $fillable =[
        'classdate',
        'post_id',
        'attcode',
        'status_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}

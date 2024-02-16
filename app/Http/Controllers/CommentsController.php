<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        Comment::create([
            'description'=>$request['description'],
            'user_id'=>$user_id,
            'commentable_id'=>$request['commentable_id'],
            'commentable_type'=>$request['commentable_type']
        ]);

        return redirect()->back();

    }
}

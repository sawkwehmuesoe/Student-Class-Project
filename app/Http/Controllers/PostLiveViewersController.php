<?php

namespace App\Http\Controllers;

use App\Events\PostLiveViewerEvent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostLiveViewersController extends Controller
{
    public function incrementviewer(Post $post){

        // auto increment to each cache keyname
        $count = Cache::increment('postliveviewer-count_'.$post->id);

        broadcast(new PostLiveViewerEvent($count,$post->id));

        return response()->json(['success'=>true]);

    }

    public function decrementviewer(Post $post){

        // auto decrement to each cache keyname
        $count = Cache::decrement('postliveviewer-count_'.$post->id);

        if($count < 0){
            $count = 0;
            Cache::put('postliveviewer-count_'.$post->id,$count);
        }

        broadcast(new PostLiveViewerEvent($count,$post->id));

        return response()->json(['success'=>true]);

    }


}

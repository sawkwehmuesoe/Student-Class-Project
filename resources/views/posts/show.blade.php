@extends('layouts.adminindex')
@section('caption','Post Show')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            <hr/>

            <div class="row">

                <div class="col-md-4">
                    <div class="card rouned-0">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}} | <span class="text-muted">{{$post->status["name"]}}</span></h5>
                        </div>

                        <ul class="list-group text-center">
                            <li class="list-group-item fw-bold"><img src="{{asset($post->image)}}" class="" alt="{{$post->title}}" width="200" height="200"></li>
                        </ul>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fas fa-user fa-sm"></i> <span>{{$post['tag']['name']}}</span>
                                    <br/>
                                    <i class="fas fa-user fa-sm"></i> <span>{{$post['type']['name']}} : {{$post->fee}}</span>
                                    <br/>
                                    <i class="fas fa-user fa-sm"></i> <span>{{$post['user']['name']}}</span>
                                </div>
                                <div class="col-md-6">
                                    <i class="fas fa-file fa-sm"></i> <span>{{$post['attstatus']['name']}}</span>
                                    <br/>
                                    <i class="fas fa-calendar-alt fa-sm"></i> <span>{{date('d M Y',strtotime($post->updated_at))}} | {{date('h:i:s A',strtotime($post->updated_at))}}</span>
                                    <br/>
                                    <i class="fas fa-edit fa-sm"></i> <span>{{date('d M Y h:i:s A',strtotime($post->updated_at))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">

                    <div class="rounded-0">

                        <ul class="list-group text-center rounded-0">
                            <li class="list-group-item active">Infomation</li>
                        </ul>

                        {{-- start remark --}}
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Info...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$post->content}}</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- end remark --}}

                    </div>

                    <div class="col-md-12">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <ul class="list-group chat-boxs">
                                    @foreach ($comments as $comment)
                                        <li class="list-group-item mt-2">
                                            <div>
                                                <p>{{$comment->description}}</p>
                                            </div>
                                            <div>
                                                <span class="small fw-bold float-end">{{$comment->user['name']}} |  {{$comment->created_at->diffForHumans()}}</span>
                                            </div>

                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="card-body border-top">
                                <form action="{{route('comments.store')}}" method="POST">

                                    @csrf

                                    <div class="col-md-12 d-flex justify-between">
                                        <textarea name="description" id="description" class="form-control border-0 rounded-0" placeholder="Comment here..." rows="1" style="resize:none;"></textarea>
                                        <button type="submit" class="btn btn-info btn-sm text-light ms-3"><i class="fas fa-paper-plane"></i></button>
                                    </div>

                                    {{-- Start Hidden Field --}}
                                    <input type="hidden" name="commentable_id" id="commentable_id" value="{{$post->id}}" />
                                    <input type="hidden" name="commentable_type" id="commentable_type" value="App\Models\Post" />
                                    {{-- End Hidden Field --}}
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


        </div>

    </div>

<!-- End Page Content Area -->

@endsection('content')

@section('css')
    <style type="text/css">
        .chat-boxs{
            height: 200px;
            overflow-y: scroll;
        }
    </style>
@endsection

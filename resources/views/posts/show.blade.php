@extends('layouts.adminindex')
@section('caption','Post Show')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            @if(!$post->checkenroll($userdata->id))
            <a href="#createmodal" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal">Enroll</a>
            @endif()

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
                                    <i class="fas fa-calendar-alt fa-sm"></i> <span>{{date('d M Y',strtotime($post->created_at))}} | {{date('h:i:s A',strtotime($post->updated_at))}}</span>
                                    <br/>
                                    <i class="fas fa-edit fa-sm"></i> <span>{{date('d M Y h:i:s A',strtotime($post->updated_at))}}</span>
                                </div>

                                <div class="col-md-6">
                                    <i class="fas fa-calendar fa-sm"></i>
                                    <span>
                                        @foreach ($dayables as $dayable)
                                            {{$dayable['name']}} ,
                                        @endforeach
                                    </span>

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

 {{-- start create model --}}
 <div id="createmodal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-0">

            <div class="modal-header">
                <h6 class="modal-title">Enroll Form</h6>
                <button category="category" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="{{route('enrolls.store')}}" method="POST" enctype="multipart/form-data"> {{--- id="{{route('categories.store')}}"  --}}

                    {{ csrf_field() }}

                    <div class="row align-items-end">

                        <div class="col-md-12 mb-3">
                            <label for="image" class="gallery">
                                <span>Chooose Image</span>
                            </label>
                            <input type="file" name="image"  id="image" class="form-control form-control-sm rounded-0"  hidden />
                        </div>

                        <div class="col-md-10">
                            <label for="remark">Remark <span class="text-danger">*</span></label>
                            <textarea category="remark" name="remark" id="remark"
                                class="form-control form-control-sm rounded-0" rows="3" placeholder="Enter Remark">{{old('remark')}}</textarea>
                        </div>

                        <div class='col-md-2 mt-3'>
                            <button category="submit" class="btn btn-primary btn-sm rounded-0">Submit</button>
                        </div>

                         {{-- Start Hidden Field --}}
                         <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}" />
                         {{-- End Hidden Field --}}
                     </form>

                    </div>

                </form>
            </div>

            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
{{-- end create model --}}

@endsection('content')

@section('css')
    <style type="text/css">

        /* Start Comment */
        .chat-boxs{
            height: 200px;
            overflow-y: scroll;
        }
        /* End Comment */

        /* Start image preview */

        .gallery{
			width: 100%;
			background-color: #eee;
			color: #aaa;

            display: flex;
            justify-content: center;
            align-items: center;

			text-align: center;
			padding: 10px;

		}

		.removetxt span{
			display: none;
		}

		.gallery img{
			width: 100px;
			height: 100px;
			border: 2px dashed #000;
		}

        /* End image preview */
    </style>
@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function(){
        // console.log("hi");

        var previewimages = function(input,output){

            if(input.files){

                var totalfiles = input.files.length;
                // console.log(totalfiles);

                if(totalfiles > 0){
                    $(".gallery").addClass('removetxt');
                }else{
                    $(".gallery").removeClass('removetxt');
                }

                for(var i=0; i < totalfiles ; i++){
                    // console.log(i);

                    var filereader = new FileReader();

                    filereader.onload = function(e){
                        $(output).html('');
                        $($.parseHTML('<img>')).attr('src',e.target.result).appendTo(output);
                    }

                    filereader.readAsDataURL(input.files[i]);

                }

            }

        }

        $("#image").change(function(){
            previewimages(this,'label.gallery');
        })

    });

</script>
@endsection

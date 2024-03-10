@extends('layouts.adminindex')
@section('caption','Create Post')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/posts" method="POST" enctype="multipart/form-data">

                @csrf
                    <div class="row">

                        <div class="col-md-4">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="image" class="gallery">
                                        <span>Chooose Image</span>
                                    </label>
                                    <input type="file" name="image"  id="image" class="form-control form-control-sm rounded-0"  hidden />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="startdate"  id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate')}}" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="enddate">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="enddate"  id="enddate" class="form-control form-control-sm rounded-0" value="{{old('enddate')}}" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="starttime">Start Time <span class="text-danger">*</span></label>
                                    <input type="time" name="starttime"  id="starttime" class="form-control form-control-sm rounded-0" value="{{old('starttime')}}" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="endtime">End Time <span class="text-danger">*</span></label>
                                    <input type="time" name="endtime"  id="endtime" class="form-control form-control-sm rounded-0" value="{{old('endtime')}}" />
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="">Days</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($days as $idx=>$day)
                                            <div class="form-check form-switch mx-3">
                                                <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input" value="{{$day->id}}" checked /><label for="day_id{{$idx}}">{{$day->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- start hidden field --}}
                                    <input type="hidden" name="dayable_type" id="dayable_type" value="App\Models\Post" />
                                    {{-- end hidden field --}}
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="row">



                                <div class="col-md-12 mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"  id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Post Title" value="{{old('title')}}" />
                                </div>

                                <div class="col-md-6">
                                    <label for="type_id">Type <span class="text-danger">*</span></label>
                                    <select name="type_id"  id="type_id" class="form-control form-control-sm rounded-0">
                                       @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fee">Fee <span class="text-danger">*</span></label>
                                    <input type="number" name="fee"  id="fee" class="form-control form-control-sm rounded-0" placeholder="Enter Fee " value="{{old('fee')}}" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content"  id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something" >{{old('content')}}</textarea>
                                </div>

                                <div class="col-md-3">
                                    <label for="tag_id">Tag <span class="text-danger">*</span></label>
                                    <select name="tag_id"  id="tag_id" class="form-control form-control-sm rounded-0">
                                       @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="attshow">Show on Att Form <span class="text-danger">*</span></label>
                                    <select name="attshow"  id="attshow" class="form-control form-control-sm rounded-0">
                                       @foreach($attshows as $attshow)
                                        <option value="{{$attshow->id}}">{{$attshow->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="status_id">Status <span class="text-danger">*</span></label>
                                    <select name="status_id"  id="status_id" class="form-control form-control-sm rounded-0">
                                       @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class='col-md-3 d-flex justify-content-end align-items-end'>

                                        <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0 ">Cancle</a>
                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                                </div>
                            </div>

                        </div>

                 </div>

             </form>

        </div>

    </div>

<!-- End Page Content Area -->

@endsection('content')

@section('css')

    {{-- summernote css1 js1 --}}
    <link href="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.css')}}" rel="stylesheet" type="text/css" />

    <style type="text/css">
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
    </style>

@endsection

@section('scripts')
{{-- summer note css1 js1  --}}
<script src="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.js')}}" type="text/javascript"></script>

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

    $('#content').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']]
        ]
    });

</script>
@endsection

@extends('layouts.adminindex')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/announcements/{{ $announcement->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-4">

                        <div class="row">
                            <div class="col-md-12 mb-3">

                                <div class="row">
                                    <div class="col-md-6 text-sm-center">
                                        <img src="{{ asset($announcement->image) }}" width=200 alt="{{ $announcement->title }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="gallery">
                                            <span>Chooose Image</span>
                                        </label>
                                        <input type="file" name="image" id="image"
                                            class="form-control form-control-sm rounded-0" value="{{ $announcement->image }}"
                                            hidden />
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="row">



                            <div class="col-md-6 mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter announcement Title"
                                    value="{{ $announcement->title }}" />
                            </div>

                            <div class="col-md-6">
                                <label for="post_id">Class <span class="text-danger">*</span></label>
                                <select name="post_id" id="post_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($posts as $id=>$title)
                                        <option value="{{ $id }}"
                                            @if ($id === $announcement['post_id'])
                                                selected
                                            @endif>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5"
                                    placeholder="Say Something">{{ $announcement->content }}</textarea>
                            </div>

                            <div class='col-md-12 d-flex justify-content-end align-items-end'>

                                <a href="{{ route('announcements.index') }}"
                                    class="btn btn-secondary btn-sm rounded-0 ">Cancle</a>
                                <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>

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
        .gallery {
            width: 100%;
            height: 100%;
            background-color: #eee;
            color: #aaa;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
            padding: 10px;

        }

        .removetxt span {
            display: none;
        }

        .gallery img {
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
        $(document).ready(function() {
            // console.log("hi");

            // Start Single Image
            var previewimages = function(input, output) {

                if (input.files) {

                    var totalfiles = input.files.length;
                    // console.log(totalfiles);

                    if (totalfiles > 0) {
                        $(".gallery").addClass('removetxt');
                    } else {
                        $(".gallery").removeClass('removetxt');
                    }

                    for (var i = 0; i < totalfiles; i++) {
                        // console.log(i);

                        var filereader = new FileReader();

                        filereader.onload = function(e) {
                            $(output).html('');
                            $($.parseHTML('<img>')).attr('src', e.target.result).appendTo(output);
                        }

                        filereader.readAsDataURL(input.files[i]);

                    }

                }

            }

            $("#image").change(function() {
                previewimages(this, 'label.gallery');
            })
            // End Single Image

            // Start Day Action
            $('.dayactions').click(function(){

                var checkboxs = $("input[type='checkbox']");
                // console.log(checkboxs);

                var checked = checkboxs.filter(':checked').map(function(){
                    // return this.value;
                    $(this).attr('name','newday_id[]');
                });

                var checked = checkboxs.not(':checked').map(function(){
                    // return this.value;
                    $(this).attr('name','oldday_id[]');
                });

                // check or uncheck
                // if($(this).prop('checked')){
                //     console.log("yes");
                //     console.log(checked);
                // }else{
                //     console.log("no");
                //     console.log(unchecked);
                // }

            });
            // End Day Action

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

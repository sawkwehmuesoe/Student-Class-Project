@extends('layouts.adminindex')
@section('caption', 'Edit Post')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-4">

                        <div class="row">
                            <div class="col-md-12 mb-3">

                                <div class="row">
                                    <div class="col-md-6 text-sm-center">
                                        <img src="{{ asset($post->image) }}" width=200 alt="{{ $post->title }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="gallery">
                                            <span>Chooose Image</span>
                                        </label>
                                        <input type="file" name="image" id="image"
                                            class="form-control form-control-sm rounded-0" value="{{ $post->image }}"
                                            hidden />
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="startdate" id="startdate"
                                    class="form-control form-control-sm rounded-0" value="{{ $post->startdate }}" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="enddate">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="enddate" id="enddate"
                                    class="form-control form-control-sm rounded-0" value="{{ $post->enddate }}" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="starttime">Start Time <span class="text-danger">*</span></label>
                                <input type="time" name="starttime" id="starttime"
                                    class="form-control form-control-sm rounded-0" value="{{ $post->starttime }}" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="endtime">End Time <span class="text-danger">*</span></label>
                                <input type="time" name="endtime" id="endtime"
                                    class="form-control form-control-sm rounded-0" value="{{ $post->endtime }}" />
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Days</label>
                                <div class="d-flex flex-wrap">
                                    @foreach ($days as $idx => $day)
                                        <div class="form-check form-switch mx-3">
                                            <input type="checkbox" name="day_id[]" id="day_id{{ $idx }}"
                                                class="form-check-input dayactions" value="{{ $day->id }}"
                                                @foreach ($dayables as $dayable)
                                                        @if ($dayable['id'] === $day['id'])
                                                            checked
                                                        @endif @endforeach /><label
                                                for="day_id{{ $idx }}">{{ $day->name }}</label>
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
                                <input type="text" name="title" id="title"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Post Title"
                                    value="{{ $post->title }}" />
                            </div>

                            <div class="col-md-6">
                                <label for="type_id">Type <span class="text-danger">*</span></label>
                                <select name="type_id" id="type_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            @if ($type['id'] === $post['type_id']) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fee">Fee <span class="text-danger">*</span></label>
                                <input type="number" name="fee" id="fee"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Fee "
                                    value="{{ $post->fee }}" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5"
                                    placeholder="Say Something">{{ $post->content }}</textarea>
                            </div>

                            <div class="col-md-3">
                                <label for="tag_id">Tag <span class="text-danger">*</span></label>
                                <select name="tag_id" id="tag_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @if ($tag->id === $post['tag_id']) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="attshow">Show on Att Form <span class="text-danger">*</span></label>
                                <select name="attshow" id="attshow" class="form-control form-control-sm rounded-0">
                                    @foreach ($attshows as $attshow)
                                        <option value="{{ $attshow->id }}"
                                            @if ($attshow['id'] === $post['attshow']) selected @endif>{{ $attshow->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="status_id">Status <span class="text-danger">*</span></label>
                                <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ $status->id === $post->status_id ? 'selected' : '' }}>{{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='col-md-3 d-flex justify-content-end align-items-end'>

                                <a href="{{ route('posts.index') }}"
                                    class="btn btn-secondary btn-sm rounded-0 ">Cancle</a>
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
    </script>
@endsection

@extends('layouts.adminindex')
@section('caption', 'Create Roles')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/roles" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="row">

                    <div class="col-md-4">


                        <label for="image" class="gallery">
                            <span>Chooose Image</span>
                        </label>

                    </div>

                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control form-control-sm rounded-0" />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Role Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-6">
                                <label for="status_id">Status <span class="text-danger">*</span></label>
                                <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0"
                                    placeholder="Enter Role Name" value="{{ old('name') }}">
                                    @foreach ($statuses as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='col-md-6 d-flex justify-content-end align-items-end'>
                                <div>
                                    <a href="{{ route('students.index') }}"
                                        class="btn btn-secondary btn-sm rounded-0 ">Cancle</a>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                </div>
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
        // Start Filter
        const getfilterbtn = document.getElementById('btn-search');

        getfilterbtn.addEventListener('click', function(e) {

            const getfiltername = document.getElementById('filtername').value;
            const getcururl = window.location.href;

            // console.log(getcururl);
            // console.log(getcururl.split('?')); // ['http://example.test/cities', 'filtername=apple']
            // console.log(getcururl.split('?')[0]);

            window.location.href = getcururl.split('?')[0] + '?filtername=' + getfiltername;
            e.preventDefault();

        })
        // End Filter

        $(document).ready(function() {
            // console.log("hi");

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

        });
    </script>
@endsection

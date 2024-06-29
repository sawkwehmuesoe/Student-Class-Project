@extends('layouts.adminindex')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('attcodegenerators.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-3 mb-3">
                        <label for="classdate">Class Date <span class="text-danger">*</span></label>
                        @error('classdate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="date" name="classdate" id="classdate" class="form-control form-control-sm rounded-0" placeholder="Enter AttcodeGenerator Name" value="{{ $gettoday }}" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="post_id">Class <span class="text-danger">*</span></label>
                        @error('post_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select name="post_id" id="post_id" class="form-control form-control-sm rounded-0">
                            <option selected disabled>Choose Class</option>
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach ($statuses as $status)
                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="attcode">Attendance Code <span class="text-danger">*</span></label>
                        @error('attcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="attcode" id="attcode" class="form-control form-control-sm rounded-0" placeholder="Enter attendance Name" value="{{ old('classdate') }}" />
                    </div>

                    <div class='col-md-12 text-end'>
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                    </div>

                </div>

            </form>

        </div>

        <hr />

        <div class="col-md-12">

            <table class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Class</th>
                        <th>Class Date</th>
                        <th>Att Code</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attcodegenerators as $idx => $attcodegenerator)
                        <tr>
                            <td>{{ ++$idx }}</td>
                            <td>{{ $attcodegenerator->post['title'] }}</td>
                            <td>{{ $attcodegenerator->classdate}}</td>
                            <td>{{ $attcodegenerator->attcode }}</td>
                            <td>{{ $attcodegenerator['user']['name'] }}</td>
                            <td>{{ $attcodegenerator->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="form-checkbox form-switch">
                                    <input type="checkbox" class="form-check-input change-btn" {{$attcodegenerator->status_id === 3 ? 'checked' : ''}} data-id="{{$attcodegenerator->id}}" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <!-- End Page Content Area -->

    {{-- Start Model Area  --}}

    {{-- End Model Area  --}}


@endsection('content')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            // Start chage-btn
            $('.change-btn').change(function(){

            var getid = $(this).data('id');
            // console.log(getid);
            var setstatus = $(this).prop('checked') === true ? 3 : 4;
            // console.log(setstatus);

            $.ajax({
                url:"attcodegeneratorsstatus",
                method:"GET",
                dataType:"json",
                data:{"id":getid,"status_id":setstatus},
                success:function(response){
                    // console.log(response);

                    // console.log(response.success);

                    Swal.fire({
                        title:"Updated!",
                        text:"Updated Successfully!",
                        icon:"success"
                    })
                }
            })

            });
            // End chage-btn


        });
    </script>
@endsection

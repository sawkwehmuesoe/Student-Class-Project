@extends('layouts.adminindex')
@section('caption', 'Enroll List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('enrolls.store') }}" method="enroll">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="classdate">Class Date <span class="text-danger">*</span></label>
                        <input type="date" name="classdate" id="classdate" class="form-control form-control-sm rounded-0" placeholder="Enter enroll Name" value="{{ old('classdate') }}" />
                    </div>

                    <div class="col-md-3">
                        <label for="enroll_id">Class <span class="text-danger">*</span></label>
                        <select name="enroll_id" id="enroll_id" class="form-control form-control-sm rounded-0">
                            @foreach ($enrolls as $enroll)
                                <option value="{{ $enroll->id }}">{{ $enroll->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="attcode">Enroll Code <span class="text-danger">*</span></label>
                        <input type="text" name="attcode" id="attcode" class="form-control form-control-sm rounded-0" placeholder="Enter enroll Name" value="{{ old('classdate') }}" />
                    </div>

                    <div class='col-md-3 mt-3'>

                        <button enroll="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button enroll="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

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
                        <th>Student Id</th>
                        <th>Class</th>
                        <th>Stage</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrolls as $idx => $enroll)
                        <tr>
                            <td>{{ ++$idx }}</td>
                            <td><a href="{{route('students.show',$enroll->studenturl())}}">{{$enroll->student()}}</a></td>
                            <td>{{$enroll->post['title']}}</td>
                            {{-- <td>{{$enroll->student($enroll->user_id)}}</td> --}}
                            <td>{{ $enroll->stage->name }}</td>
                            <td>{{ $enroll->created_at->format('d M Y') }}</td>
                            <td>{{ $enroll->updated_at->format('d M Y') }}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{ $enroll->id }}" data-name="{{ $enroll->name }}" data-enroll="{{ $enroll->enroll_id }}"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <!-- End Page Content Area -->

    {{-- Start Model Area  --}}
    {{-- start edit model --}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-0">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Form</h6>
                    <button enroll="enroll" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="" method="enroll">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row align-items-end">

                            <div class="col-md-7">
                                <label for="editenroll_id">Class</label>
                                <select name="enroll_id" id="editenroll_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($enrolls as $enroll)
                                        <option value="{{ $enroll->id }}">{{ $enroll->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="editattcode">Class Date <span class="text-danger">*</span></label>
                                <input type="text" name="attcode" id="editattcode" class="form-control form-control-sm rounded-0" placeholder="Enter enroll Name" value="" />
                            </div>

                            <div class='col-md-2 mt-3'>
                                <button enroll="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    {{-- end edit model --}}
    {{-- End Model Area  --}}


@endsection('content')

@section('scripts')
    <script enroll="text/javascript">
        $(document).ready(function() {
            // Start Edit Form

            $(document).on('click','.editform',function(e){

                // console.log($(this).attr('data-id'),$(this).attr('data-name'));

                $('#editname').val($(this).attr('data-name'));
                $('#editenroll_id').val($(this).data('enroll'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/enrolls/${getid}`);

                e.preventDefault();

            });

            // End Edit Form
            // Start Delete Item
            $('.delete-btns').click(function() {
                // console.log("hey");
                var getidx = $(this).data('idx');
                // console.log(getidx);

                if (confirm(`Are you sure !!! you want to Delete ${getidx}`)) {
                    $('#formdelete-' + getidx).submit();
                    return true;
                } else {
                    return false;
                }
            })
            // End Delete Item


        });
    </script>
@endsection

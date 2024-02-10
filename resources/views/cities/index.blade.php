@extends('layouts.adminindex')
@section('caption', 'city List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('cities.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="name">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0"
                            placeholder="Enter Name" value="{{ old('name') }}" />
                    </div>

                    <div class='col-md-6 mt-3'>

                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                    </div>

                </div>

            </form>

        </div>

        <hr />

        <div class="col-md-12">

            <div class="col-md-12">

                <table class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $idx => $city)
                            <tr>
                                <td>{{ ++$idx }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->user->name }}</td>
                                <td>{{ $city->created_at->format('d M Y') }}</td>
                                <td>{{ $city->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal"
                                        data-bs-target="#editmodal" data-id="{{ $city->id }}"
                                        data-name="{{ $city->name }}"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2"
                                        data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{ $idx }}"
                                    action="{{ route('cities.destroy', $city->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <!-- End Page Content Area -->

    {{-- Start Model Area  --}}
    {{-- start edit model --}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered ">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Form</h6>
                    <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label for="editname">City Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="editname"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class='col-md-4 mt-3'>
                                <button type="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
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

    <script type="text/javascript">
        $(document).ready(function() {

            $('.delete-btns').click(function() {

                const getidx = $(this).data('idx');

                if (confirm(`Are you sure !!! you want to Delete ${getidx}`)) {
                    $('#formdelete-' + getidx).submit();
                    return true;
                } else {
                    return false;
                }

            });

            // Start Edit Form

            $(document).on('click', '.editform', function(e) {

                // console.log("hey");
                // console.log($(this).attr('data-id'),$(this).data('name'));

                $("#editname").val($(this).data('name'));

                const getid = $(this).data('id');
                $('#formaction').attr('action', `/cities/${getid}`);

                e.preventDefault();

            });

            // End Edit Form

        });
    </script>

@endsection

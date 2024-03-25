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
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="filtername" id="filtername"
                                    class="form-control form-control-sm rounded-0" placeholder="Search...">
                                <button type="submit" id="btn-search" class="btn btn-secondary btn-sm "><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

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

                {{ $cities->links('pagination::bootstrap-4') }}

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
        // Start Filter
        const getfilterbtn = document.getElementById('btn-search');

        getfilterbtn.addEventListener('click',function(e){

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

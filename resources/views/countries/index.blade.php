@extends('layouts.adminindex')
@section('caption', 'Country List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('countries.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-3 form-group mb-3">
                        <label for="name">First Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach ($statuses as $status)
                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='col-md-6 mb-3 text-sm-end text-start'>

                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                    </div>

                </div>

            </form>

        </div>

        <hr />

        <div class="col-md-12">

            <div>
                <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
            </div>

            <form action="" method="">
                <div class="row justify-content-end">
                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="input-group">
                            <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search...">
                            <button type="submit" id="search" class="btn btn-secondary btn-sm "><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">

            <div class="col-md-12">

                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" >
                            </th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $idx => $country)
                            <tr>
                                <td><input type="checkbox" name="singlechecks" class="form-check-input" value="{{$country->id}}" /></td>
                                <td>{{ ++$idx }}</td>
                                <td>{{ $country->name }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input change-btn" {{ $country->status_id === 3 ? 'checked' : ''}} data-id="{{$country->id}}" />
                                    </div>
                                </td>
                                <td>{{ $country->user->name }}</td>
                                <td>{{ $country->created_at->format('d M Y') }}</td>
                                <td>{{ $country->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal"
                                        data-bs-target="#editmodal" data-id="{{ $country->id }}"
                                        data-name="{{ $country->name }}" data-status="{{$country->status_id}}" ><i class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2"
                                        data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{ $idx }}"
                                    action="{{ route('countries.destroy', $country->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $countries->links('pagination::bootstrap-4') }} --}}
            </div>

        </div>

    </div>

    <!-- End Page Content Area -->

    {{-- Start Model Area  --}}
    {{-- start edit model --}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
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
                            <div class="col-md-6 form-group mb-3">
                                <label for="editname">country Name <span class="text-danger">*</span></label>
                                <input type="text" name="editname" id="editname"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="editstatus_id">Status</label>
                                <select name="editstatus_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='col-md-2 text-sm-end text-start mb-3'>
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

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                $("#editstatus_id").val($(this).attr('data-status'));

                const getid = $(this).data('id');
                $('#formaction').attr('action', `/countries/${getid}`);

                e.preventDefault();

            });

            // End Edit Form

             // Start chage-btn

             $('.change-btn').change(function(){

                var getid = $(this).data('id');
                console.log(getid);

                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"/countriesstatus",
                    method:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){

                        // console.log(response.success);

                        Swal.fire({
                            title:"Updated!",
                            text:"Updated Successfully!",
                            icon:"success"
                        })

                    }

                })

                })

                // End chage-btn

        });
    </script>

@endsection

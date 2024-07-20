@extends('layouts.adminindex')
@section('caption', 'Gender List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('genders.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="name">First Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror rounded-0"
                            placeholder="Enter Name" value="{{ old('name') }}" />
                        {{-- @error('name')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror --}}
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

                <div>
                    <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                </div>

                <div>
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
            </div>

            <div class="col-md-12">

                <table class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" >
                            </th>
                            <th>No</th>
                            <th>Name</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genders as $idx => $gender)
                            <tr id="delete_{{$gender->id}}">
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$gender->id}}" >
                                </td>
                                <td>{{ ++$idx }}</td>
                                <td>{{ $gender->name }}</td>
                                <td>{{ $gender->user->name }}</td>
                                <td>{{ $gender->created_at->format('d M Y') }}</td>
                                <td>{{ $gender->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal"
                                        data-bs-target="#editmodal" data-id="{{ $gender->id }}"
                                        data-name="{{ $gender->name }}"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2"
                                        data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{ $idx }}"
                                    action="{{ route('genders.destroy', $gender->id) }}" method="POST">
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
                                <label for="editname">gender Name <span class="text-danger">*</span></label>
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

                const getid = $(this).data('id');
                $('#formaction').attr('action', `/genders/${getid}`);

                e.preventDefault();

            });

            // End Edit Form

             // Start Bulk Delete
             $("#selectalls").click(function(){
                $(".singlechecks").prop('checked',$(this).prop('checked'));
            })

            $("#bulkdelete-btn").click(function(){

                let getselectedids = [];

                // console.log($("input:checkbox[name=singlechecks]:checked"));

                $("input:checkbox[name=singlechecks]:checked").each(function(){
                    getselectedids.push($(this).val());
                });

                // console.log(getselectedids);

                Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                            }).then((result) => {

                            if (result.isConfirmed) {

                                // data remove

                                $.ajax({
                                    url:'{{route("genders.bulkdeletes")}}',
                                    type:"DELETE",
                                    dataType:"json",
                                    data:{
                                        selectedids:getselectedids,
                                        _token:'{{csrf_token()}}'
                                    },
                                    success:function(response){
                                        // console.log(response);

                                        if(response){

                                            $.each(getselectedids,function(key,val){
                                                $(`#delete_${val}`).remove();
                                            })

                                            Swal.fire({
                                            title: "Deleted!",
                                            text: "Your file has been deleted.",
                                            icon: "success"
                                            });
                                        }
                                    },
                                    error:function(response){
                                        console.log("Error : ",response);
                                    }
                                });
                            }
                        });

            });

            // End Bulk Delete

        });
    </script>

@endsection

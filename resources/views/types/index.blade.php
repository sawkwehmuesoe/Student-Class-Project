@extends('layouts.adminindex')
@section('caption', 'Type List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{ route('types.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0"
                            placeholder="Enter Type Name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-4">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach ($statuses as $status)
                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='col-md-4 mt-3'>

                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                    </div>

                </div>

            </form>

        </div>

        <hr />

        <div class="col-md-12">

            <div class="col-md-12 row mb-3">

                <div class="col-3">
                    <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                </div>

                <div class="col-9">
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

                    </tbody>
                </table>

            </div>

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
                    <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row align-items-end">
                            <div class="col-md-7">
                                <label for="editname">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="editname"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-3">
                                <label for="editstatus_id">Status</label>
                                <select name="status_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class='col-md-2 mt-3'>
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

@section('css')
    <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')

    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Start Passing Header Token

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            })

            // End Passing Header Token

            // Start Fetch All Data

            async function fetchalldatas(query = ""){

                await $.ajax({
                    url:"{{url('api/typessearch')}}",
                    method:"GET",
                    type:"JSON",
                    data:{"query":query},
                    success:function(response){

                        // console.log(response);

                        const datas = response.data;

                        let html;

                        datas.forEach(function(data,idx){

                            // console.log(data);

                            html += `
                                    <tr id="${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input" value="${data.id}" />
                                        </td>
                                        <td>${idx++}</td>
                                        <td>${data.name}</td>
                                        <td>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}"  />
                                            </div>
                                        </td>
                                        <td>${data.user.name}</td>
                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${idx}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                            `;

                        })

                        $("#mytable tbody").html(html);

                    }
                })

            }

            fetchalldatas();

            // End Fetch All Data

            // Start Filter By Search Query

            $("#btn-search").on('click',function(e){

                e.preventDefault();
                // console.log("heii");

                const query = $("#filtername").val();

                // console.log(query);

                fetchalldatas(query);

            });

            // End Filter By Search Query

            // Start Edit Form

            $(document).on('click','.editform',function(e){

                // console.log($(this).attr('data-id'),$(this).attr('data-name'));

                $('#editname').val($(this).attr('data-name'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/types/${getid}`);

                e.preventDefault();

            });

            // End Edit Form
            // Start Delete Item
            // $('.delete-btns').click(function() {
            //     // console.log("hey");
            //     var getidx = $(this).data('idx');
            //     // console.log(getidx);

            //     if (confirm(`Are you sure !!! you want to Delete ${getidx}`)) {
            //         $('#formdelete-' + getidx).submit();
            //         return true;
            //     } else {
            //         return false;
            //     }
            // });

                // By Ajax
            $('.delete-btns').click(function(){
                const getidx = $(this).attr('data-idx');
                var getid = $(this).data('id');
                // console.log(getid);

                if (confirm(`Are you sure !!! you want to Delete ${getidx}`)) {

                    // ui remove
                    $(this).parent().parent().remove();

                    // data remove

                    $.ajax({
                        url:"typesdelete",
                        type:"GET",
                        dataType:"json",
                        data:{"id":getid},
                        success:function(response){
                            window.alert(response.success);
                        }
                    });
                } else {
                    return false;
                }


            });


            // End Delete Item

            // $('#mytable').DataTable();

            // Start chage-btn
            $('.change-btn').change(function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                // console.log(setstatus);

                $.ajax({
                    url:"typesstatus",
                    type:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){
                        // console.log(response);

                        console.log(response.success);
                    }
            })

            });
            // End chage-btn


        });
    </script>
@endsection

{{--
@foreach ($types as $idx => $type)
<tr>
    <td>{{ ++$idx }}</td>
    <td>{{ $type->name }}</td>
    <td>
        <div class="form-checkbox form-switch">
            <input type="checkbox" class="form-check-input change-btn" {{$type->status_id === 3 ? 'checked' : ''}} data-id="{{$type->id}}" />
        </div>
    </td>
    <td>{{ $type['user']['name'] }}</td>
    <td>{{ $type->created_at->format('d M Y') }}</td>
    <td>{{ $type->updated_at->format('d M Y') }}</td>
    <td>
        <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{ $type->id }}" data-name="{{ $type->name }}" data-status="{{ $type->status_id }}"><i class="fas fa-pen"></i></a> --}}
        {{-- <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a> --}}
        {{-- <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="{{$idx}}" data-id="{{ $type->id }}"><i class="fas fa-trash-alt"></i></a>
    </td> --}}
    {{-- <form id="formdelete-{{ $idx }}" action="{{ route('types.destroy', $type->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form> --}}
{{-- </tr>
@endforeach --}}

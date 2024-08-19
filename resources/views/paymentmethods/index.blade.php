@extends('layouts.adminindex')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">



        <div class="col-md-12">

            <form id="createform" action="{{ route('paymentmethods.store') }}">

                <div class="row align-items-end">
                    <div class="col-md-3 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0"
                            placeholder="Enter Paymentmethod Name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="paymenttype_id">Payment Type</label>
                        <select name="paymenttype_id" id="paymenttype_id" class="form-control form-control-sm rounded-0">
                            @foreach ($paymenttypes as $paymenttype)
                                <option value="{{ $paymenttype['id'] }}">{{ $paymenttype['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach ($statuses as $status)
                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='col-md-3 mt-3'>

                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                    </div>

                </div>

            </form>

        </div>

        <hr />

        <div class="col-md-12">

            <div>
                <a href="javascript:void(0)" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0 mb-3">Bulk Delete</a>
            </div>

        </div>

        <div class="col-md-12">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls">
                        </th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentmethods as $idx => $paymentmethod)
                        <tr id="delete_{{$paymentmethod->id}}">
                            <td>
                                <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$paymentmethod->id}}" >
                            </td>
                            <td>{{ ++$idx }}</td>
                            <td>{{ $paymentmethod->name }}</td>
                            <td>{{ $paymentmethod->paymenttype['name'] }}</td>
                            <td>
                                <div class="form-checkbox form-switch">
                                    <input type="checkbox" class="form-check-input change-btn" {{$paymentmethod->status_id === 3 ? 'checked' : ''}} data-id="{{$paymentmethod->id}}" />
                                </div>
                            </td>
                            <td>{{ $paymentmethod['user']['name'] }}</td>
                            <td>{{ $paymentmethod->created_at->format('d M Y') }}</td>
                            <td>{{ $paymentmethod->updated_at->format('d M Y') }}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{ $paymentmethod->id }}" data-name="{{ $paymentmethod->name }}" data-paymenttype="{{$paymentmethod->paymenttype_id}}" data-status="{{ $paymentmethod->status_id }}"><i class="fas fa-pen"></i></a>
                                {{-- <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a> --}}
                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="{{$idx}}" data-id="{{ $paymentmethod->id }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            {{-- <form id="formdelete-{{ $idx }}" action="{{ route('paymentmethods.destroy', $paymentmethod->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form> --}}
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
                    <button type="paymentmethod" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="" method="">

                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="editname">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="editname"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-3">
                                <label for="editpaymenttype_id">Payment Type</label>
                                <select name="paymenttype_id" id="editpaymenttype_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($paymenttypes as $paymenttype)
                                        <option value="{{ $paymenttype['id'] }}">{{ $paymenttype['name'] }}</option>
                                    @endforeach
                                </select>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            // Start Passing Header Token
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            })
            // End Passing Header Token

            // Start Create Form

            $('#create-btn').click(function(e){

                e.preventDefault();
                // console.log("hi");

                $.ajax({
                    url:"{{route('paymentmethods.store')}}",
                    type:"POST",
                    dataType:"json",
                    // data:$("#createform").serialize(),
                    data:$("#createform").serializeArray(),
                    success:function(response){
                        // console.log(response);
                        // console.log(response.status);

                        const data = response.data;

                        $('#mytable').prepend(
                            `
                            <tr id="${'delete_'+data.id}">
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" >
                                </td>
                                <td>${data.id}</td>
                                <td>${data.name}</td>
                                <td>
                                    <div class="form-checkbox form-switch">
                                        <input type="checkbox" class="form-check-input change-btn" ${data.status_id === 3 ? 'checked' : ''} data-id="${data.id}" />
                                    </div>
                                </td>
                                <td>${data.user_id}</td>
                                <td>${data.created_at}</td>
                                <td>${data.updated_at}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger delete-btns ms-2"  data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            `
                        )
                    },
                    error:function(response){
                        console.log("Error : ", response);
                    }
                })

            });

            // End Create Form

            // Start Edit Form

            $(document).on('click','.editform',function(){

                // console.log($(this).attr('data-id'),$(this).attr('data-name'));

                $('#editname').val($(this).attr('data-name'));
                $('#editpaymenttype_id').val($(this).data('paymenttype'));
                $('#editstatus_id').val($(this).data('status'));



                const getid = $(this).attr('data-id');
                // $('#formaction').attr('action',`/paymentmethods/${getid}`);

                $('#formaction').attr('data-id',getid);

            });

            $('#formaction').submit(function(e){

                e.preventDefault();

                const getid = $(this).attr('data-id');
                // const getid = 5;
                console.log(getid);

                $.ajax({
                    url:`paymentmethods/${getid}`,
                    type:"PUT",
                    dataType:"json",
                    data:$("#formaction").serialize(),  //name=kpay&status_id=4
                    success:function(response){
                        // console.log(this.data);  //name=kpay&status_id=4
                        // console.log(response);
                        // console.log(response.status);
                        $('#editmodal').modal('hide');

                        window.location.reload(); //temp reload
                    }
                });

                // console.log('hello');

            })

            // End Edit Form
            // Start Delete Item

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
                        url:`paymentmethods/${getid}`,
                        type:"DELETE",
                        dataType:"json",
                        // data:{_token:"{{csrf_token()}}"},
                        success:function(response){
                            if(response && response.status === "success"){
                                const getdata = response.data;
                                $(`#delete_${getdata.id}`).remove();
                            }
                        }
                    });
                } else {
                    return false;
                }


            });


            // End Delete Item


            // Start chage-btn
            $('.change-btn').change(function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                // console.log(setstatus);

                $.ajax({
                    url:"paymentmethodsstatus",
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

            // Start Bulk Delete
            $("#selectalls").click(function(){
                $(".singlechecks").prop('checked',$(this).prop('checked'));
            });


            $("#bulkdelete-btn").click(function(){

                let getselectedids = [];

                // console.log($("input:checkbox[name=singlechecks]:checked"));

                $("input:checkbox[name=singlechecks]:checked").each(function(){
                    getselectedids.push($(this).val());
                });

                // console.log(getselectedids);

                // $.ajax({
                //     url:'{{route("days.bulkdeletes")}}',
                //     type:"DELETE",
                //     dataType:'json',
                //     data:{
                //         selectedids:getselectedids,
                //         _token:'{{csrf_token()}}'
                //     },
                //     success:function(response){
                //         // console.log(response);

                //         if(response){
                //             $.each(getselectedids,function(key,val){
                //                 $(`#delete_${val}`).remove();
                //             });
                //         }

                //     },
                //     error:function(response){
                //         console.log('Error ',response);
                //     }
                // })

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
                                    url:'{{route("paymentmethods.bulkdeletes")}}',
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

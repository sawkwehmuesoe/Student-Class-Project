@extends('layouts.adminindex')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="javascript:void(0);" id="modal-btn" class="btn btn-primary btn-sm rounded-0">Create</a>

        </div>

        <hr />

        <div class="col-md-12">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
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
                    {{-- @foreach ($socialapplications as $idx => $socialapplication)
                        <tr id="delete_{{$socialapplication->id}}">
                            <td>{{ ++$idx }}</td>
                            <td>{{ $socialapplication->name }}</td>
                            <td>
                                <div class="form-checkbox form-switch">
                                    <input type="checkbox" class="form-check-input change-btn" {{$socialapplication->status_id === 3 ? 'checked' : ''}} data-id="{{$socialapplication->id}}" />
                                </div>
                            </td>
                            <td>{{ $socialapplication['user']['name'] }}</td>
                            <td>{{ $socialapplication->created_at->format('d M Y') }}</td>
                            <td>{{ $socialapplication->updated_at->format('d M Y') }}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-info edit-btns" data-id="{{ $socialapplication->id }}"><i class="fas fa-pen"></i></a>
                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="{{$idx}}" data-id="{{ $socialapplication->id }}"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>
                    @endforeach --}}
                </tbody>
            </table>

        </div>

    </div>

    <!-- End Page Content Area -->

    {{-- Start Model Area  --}}

     {{-- start create model --}}
     <div id="createmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-0">

                <div class="modal-header">
                    <h6 class="modal-title">Title</h6>
                    <button type="socialapplication" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction">

                        <div class="row align-items-end px-3">
                            <div class="col-md-7">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Application Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-3">
                                <label for="status_id">Status</label>
                                <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="id" id="id">

                            <div class='col-md-2 mt-3'>
                                <button type="submit" id="action-btn" class="btn btn-primary btn-sm rounded-0" value="action-type">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    {{-- end create model --}}

    {{-- start edit model --}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-0">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Form</h6>
                    <button type="socialapplication" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="" method="">

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

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js" type="text/javascript"></script>
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

            // Start Fetch All Datas

            function fetchalldatas(){

                $.ajax({
                    url:"{{route('socialapplications.fetchalldatas')}}",
                    method:"GET",
                    type:"JSON",
                    success:function(response){
                        // console.log(response);

                        const datas = response.data;

                        // console.log(datas);

                        let html;

                        datas.forEach(function(data,idx){
                            // console.log(data);

                            html += `
                                        <tr id="${data.id}">
                                            <td>${++idx}</td>
                                            <td>${data.name}</td>
                                            <td>
                                                <div class="form-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                                </div>
                                            </td>
                                            <td>${data.user_id}</td>
                                            <td>${data.created_at}</td>
                                            <td>${data.updated_at}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${idx}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `;

                        });

                        $("#mytable tbody").prepend(html);
                    }
                })

            }

            fetchalldatas();

            // End Fetch All Datas

            // Start Create Form

            $('#modal-btn').click(function(){

                // clear form data
                // console.log($("#formaction"));
                // console.log($("#formaction")[0]);

                // method 1
                // $("#formaction")[0].reset(); //if you use reset() ! that element can't be array.needed to convert element

                // method 2
                $("#formaction").trigger("reset");

                $("#createmodal .modal-title").text("Create Form");

                $("#action-btn").val("create-btn");

                $('#createmodal').modal("show"); //toggle
            })

            $('#formaction').validate({

                rules:{
                    name:"required"
                },

                messages:{
                    name:"Please enter the application name"
                },

                submitHandler:function(form){

                    let actiontype = $("#action-btn").val();

                    if(actiontype === "create-btn"){
                        $("#action-btn").text("Sending...");

                        // let formdata = $('#formaction').serialize();
                        // let formdata = $(form).serialize();
                        // let formdata = $('#formaction').serializeArray();
                        let formdata = $(form).serializeArray();

                        $.ajax({
                            data:formdata,
                            url:"{{route('socialapplications.store')}}",
                            type:"POST",
                            dataType:'json',
                            success:function(response){

                                // console.log(response);
                                // console.log(response.status);

                                if(response && response.status === 'success'){
                                    $('#createmodal').modal("hide"); //toggle

                                    const data = response.data;

                                    let html = `
                                        <tr id="${data.id}">
                                            <td>${data.id}</td>
                                            <td>${data.name}</td>
                                            <td>
                                                <div class="form-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                                </div>
                                            </td>
                                            <td>${data.user_id}</td>
                                            <td>${data.created_at}</td>
                                            <td>${data.updated_at}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `;

                                    $("#mytable tbody").prepend(html);

                                    $("#action-btn").text("Submit");

                                }

                            },
                            error:function(response){
                                console.log("Error : ",response);
                            }
                        })

                    }else{

                        $("#action-btn").text("Sending...");

                        const getid = $('#id').val();

                        $.ajax({
                            url:`socialapplications/${getid}`,
                            type:"PUT",
                            dataType:"json",
                            data:$("#formaction").serialize(),  //name=kpay&status_id=4
                            success:function(response){
                                // console.log(this.data);  //name=kpay&status_id=4
                                // console.log(response);
                                // console.log(response.status);

                                const data = response.data;

                                let html = `
                                    <tr id="${data.id}">
                                        <td>${data.id}</td>
                                        <td>${data.name}</td>
                                        <td>
                                            <div class="form-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                            </div>
                                        </td>
                                        <td>${data.user_id}</td>
                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                `;

                                $("#delete_"+data.id).replaceWith(html);

                                $("#action-btn").text("Update");

                                $('#createmodal').modal('hide');

                            }
                        });

                    }



                }

            })

            // End Create Form

            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`socialapplications/${getid}/edit`,function(response){
                    // console.log(response);

                    $("#createmodal .modal-title").text("Edit Form");
                    $('#action-btn').text("Update");
                    $('#action-btn').val("edit-btn");
                    $('#createmodal').modal("show"); //toggle

                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#status_id').val(response.status_id);

                });


            });

            // End Edit Form

            // Start Delete Item

            // By Ajax
            $(document).on('click','.delete-btns',function(){
                const getidx = $(this).attr('data-idx');
                var getid = $(this).data('id');
                // console.log(getid);

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


                                // ui remove
                                $(this).parent().parent().remove();

                                // data remove

                                $.ajax({
                                    url:`socialapplications/${getid}`,
                                    type:"DELETE",
                                    dataType:"json",
                                    // data:{_token:"{{csrf_token()}}"},
                                    success:function(response){
                                        // console.log(response);

                                        if(response){

                                            // ui remove

                                            $(`#delete_${getid}`).remove();

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


            // End Delete Item

            $('#mytable').DataTable();

            // Start chage-btn
            $(document).on('click','.change-btn',function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                // console.log(setstatus);

                $.ajax({
                    url:"socialapplicationsstatus",
                    method:"GET",
                    type:"json",
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){
                        console.log(response);

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

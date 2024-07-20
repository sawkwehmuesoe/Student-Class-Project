@extends('layouts.adminindex')
@section('caption', 'city List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            {{-- <form action="/cities" method="POST"> --}}
            {{-- <form action="cities" method="POST"> --}}
            {{-- <form action="{{url('cities')}}" method="POST"> --}}
            {{-- <form action="{{ route('cities.store') }}" method="POST"> --}}
            <form id="createform">

                <div class="row align-items-end">
                    <div class="col-md-3  mb-3">
                        <label for="name">First Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0"
                            placeholder="Enter Name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="country_id">Country</label>
                        <select name="country_id" id="country_id" class="form-control form-control-sm rounded-0">
                            @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
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

                    <input type="hidden" name="user_id" id="user_id" value="{{$userdata['id']}}">

                    <div class='col-md-3 text-sm-end text-md-start mb-3'>

                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

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

            <div class="col-md-12 loader-container">

                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" >
                            </th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Country</th>
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

                <div class="loader">

                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>

                </div>

                {{ $cities->links('pagination::bootstrap-4') }}

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
                    <form id="editform">

                        <div class="row align-items-end">
                            <div class="col-md-5 form-group mb-3">
                                <label for="editname">City Name <span class="text-danger">*</span></label>
                                <input type="text" name="editname" id="editname"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="editcountry_id">Country</label>
                                <select name="editcountry_id" id="editcountry_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <label for="status_id">Status</label>
                                <select name="editstatus_id" id="status_id" class="form-control form-control-sm rounded-0">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="user_id" id="user_id" value="{{$userdata['id']}}">

                            <div class='col-md-12 text-end mb-3'>
                                <button type="submit" id="edit-btn" class="btn btn-primary btn-sm rounded-0">Update</button>
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

@section('css')
    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                    url:"{{'api/cities'}}",

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
                                        <tr id="delete_${data.id}">
                                            <td><input type="checkbox" name="singlechecks" class="form-check-input" value="${data.id}" /></td>
                                            <td>${++idx}</td>
                                            <td>${data.name}</td>
                                            <td>${data.country["name"]}</td>
                                            <td>
                                                <div class="form-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
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

                        });

                        $("#mytable tbody").prepend(html);
                    }
                })

            }

            fetchalldatas();

            // End Fetch All Datas

            // Start Create Form

            $('#createform').validate({

                rules:{
                    name:"required"
                },

                messages:{
                    name:"Please enter the city name"
                },

                submitHandler:function(form){

                        $("#create-btn").text("Sending...");

                        // let formdata = $('#formaction').serialize();
                        // let formdata = $(form).serialize();
                        // let formdata = $('#formaction').serializeArray();
                        let formdata = $(form).serializeArray();

                        $.ajax({
                            url:"{{url('api/cities')}}",
                            type:"POST",
                            dataType:'json',
                            data:formdata,
                            success:function(response){

                                // console.log(response);

                                if(response){


                                    const data = response.data;

                                    let html = `
                                        <tr id="delete_${data.id}">
                                            <td><input type="checkbox" name="singlechecks" class="form-check-input" value="${data.id}" /></td>
                                            <td>${data.id}</td>
                                            <td>${data.name}</td>
                                            <td>${data.country["name"]}</td>
                                            <td>
                                                <div class="form-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                                </div>
                                            </td>
                                            <td>${data.user["name"]}</td>
                                            <td>${data.created_at}</td>
                                            <td>${data.updated_at}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `;

                                    $("#mytable tbody").prepend(html);

                                    $("#create-btn").text("Submit");

                                    Swal.fire({
                                        title:"Added!",
                                        text:"Created Successfully!",
                                        icon:"success"
                                    })

                                }

                            },
                            error:function(response){
                                console.log("Error : ",response);
                                $("#create-btn").text("Try Again");
                            }
                        })





                }

            })

            // End Create Form

            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`cities/${getid}/edit`,function(response){
                    // console.log(response);

                    $('#editmodal').modal("show"); //toggle

                    $('#id').val(response.id);
                    $('#editname').val(response.name);
                    $('#editcountry_id').val(response.country_id);
                    $('#status_id').val(response.status_id);

                });


            });

            // End Edit Form

            // Start Edit Model

            $('#editform').validate({

                rules:{
                    editname:"required"
                },

                messages:{
                    editname:"Please enter the city name"
                },

                submitHandler:function(form){

                        const getid = $("#id").val();

                        $("#edit-btn").text("Sending...");

                        // let formdata = $('#formaction').serialize();
                        // let formdata = $(form).serialize();
                        // let formdata = $('#formaction').serializeArray();
                        let formdata = $(form).serializeArray();

                        $.ajax({
                            url:`api/cities/${getid}`,
                            type:"PUT",
                            dataType:'json',
                            data:formdata,
                            success:function(response){

                                // console.log(response);

                                if(response){


                                    const data = response.data;

                                    let html = `
                                        <tr id="delete_${data.id}">
                                            <td><input type="checkbox" name="singlechecks" class="form-check-input" value="${data.id}" /></td>
                                            <td>${data.id}</td>
                                            <td>${data.name}</td>
                                            <td>${data.country["name"]}</td>
                                            <td>
                                                <div class="form-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                                </div>
                                            </td>
                                            <td>${data.user["name"]}</td>
                                            <td>${data.created_at}</td>
                                            <td>${data.updated_at}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-info edit-btns" data-id="${data.id}"><i class="fas fa-pen"></i></a>
                                                <a href="javascript:void(0);" class="text-danger delete-btns ms-2" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `;

                                    $("#delete_"+data.id).replaceWith(html);

                                    $("#editmodal").modal("hide"); //toggle

                                    Swal.fire({
                                        title:"Added!",
                                        text:"Update Successfully!",
                                        icon:"success"
                                    })

                                }

                            },
                            error:function(response){
                                console.log("Error : ",response);
                                $("#edit-btn").text("Try Again");
                            }
                        })





                }

                })

            // End Edit Model

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
                                // $(this).parent().parent().remove();

                                // ui remove

                                $(`#delete_${getid}`).remove();


                                // data remove

                                $.ajax({
                                    url:`api/warehouses/${getid}`,
                                    type:"DELETE",
                                    dataType:"json",
                                    // data:{_token:"{{csrf_token()}}"},
                                    success:function(response){
                                        // console.log(response);

                                        if(response){

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

            // $('#mytable').DataTable();

            // Start chage-btn
            $(document).on('click','.change-btn',function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                // console.log(setstatus);

                $.ajax({
                    url:"api/citiesstatus",
                    method:"PUT",
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


                // $.ajax({
                //     url:'{{route("cities.bulkdeletes")}}',
                //     type:"DELETE",
                //     dataType:"json",
                //     data:{
                //         selectedids:getselectedids,
                //         _token:'{{csrf_token()}}'
                //     },
                //     success:function(response){
                //         // console.log(response);

                //         if(response){
                            // $.each(getselectedids,function(key,val){
                            //     $(`#delete_${val}`).remove();
                            // })
                //         }

                //     },
                //     error:function(response){
                //         console.log('Error ',response);
                //     }
                // });

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
                                    url:'{{route("cities.bulkdeletes")}}',
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

@extends('layouts.adminindex')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="javascript:void(0);" id="createmodal-btn" class="btn btn-primary btn-sm rounded-0 me-3">Create</a>
            <a href="javascript:void(0);" id="setmodal-btn" class="btn btn-info btn-sm rounded-0">Set to User</a>

        </div>

        <hr />

        <div class="col-md-12 loader-container">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" >
                        </th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration/Day</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tabledata">

                </tbody>
            </table>

            <div class="loader">

                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>

            </div>

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
                    <form id="createform">

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Application Name"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" name="price" id="price"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Price"
                                    value="{{ old('price') }}" />
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="duration">Duration <span class="text-danger">*</span></label>
                                <input type="number" name="duration" id="duration"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Total Day"
                                    value="{{ old('duration') }}" />
                            </div>

                            <input type="hidden" name="packageid" id="packageid">

                            <div class='col-md-12 text-end'>
                                <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0" value="action-type">Submit</button>
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

     {{-- start set model --}}
     <div id="setmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-0">

                <div class="modal-header">
                    <h6 class="modal-title">Title</h6>
                    <button type="socialapplication" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="setform">

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="setuser_id">User ID <span class="text-danger">*</span></label>
                                <input type="text" name="setuser_id" id="setuser_id"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter User ID"
                                    value="{{ old('setuser_id') }}" />
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="package_id">Package ID <span class="text-danger">*</span></label>
                                <input type="number" name="package_id" id="package_id"
                                    class="form-control form-control-sm rounded-0" placeholder="Enter Price"
                                    value="{{ old('package_id') }}" />
                            </div>

                            <div class='col-md-12 text-end'>
                                <button type="submit" id="set-btn" class="btn btn-primary btn-sm rounded-0">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
    {{-- end set model --}}

    {{-- End Model Area  --}}


@endsection

@section('css')
    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')

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
                    url:"{{route('packages.index')}}",
                    method:"GET",
                    beforeSend:function(){
                        // console.log('before');
                        $('.loader').addClass('show');
                    },
                    success:function(response){
                        // console.log(response);
                        $("#tabledata").html(response);
                    },
                    complete:function(){
                        // console.log('complete');
                        $('.loader').removeClass('show');
                    }
                })

            }

            fetchalldatas();

            // End Fetch All Datas

            // Start Create Packages

            $('#createmodal-btn').click(function(){

                // clear form data

                // method 1
                // $("#createform")[0].reset(); //if you use reset() ! that element can't be array.needed to convert element

                // method 2
                $("#createform").trigger("reset");

                $("#createmodal .modal-title").text("Create Package");
                $("#create-btn").html("Add New Package");
                $("#create-btn").val("action-type");

                $('#createmodal').modal("show"); //toggle
            });

            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`/packages/${getid}`,function(response){
                    // console.log(response);

                    $("#createmodal .modal-title").text("Edit Package");
                    $('#create-btn').text("Update Package");
                    $('#create-btn').val("edit-type");
                    $('#createmodal').modal("show"); //toggle

                    $('#packageid').val(response.id);
                    $('#name').val(response.name);
                    $('#price').val(response.price);
                    $('#duration').val(response.duration);

                });


            });

            // End Edit Form

            // Start Create & Update Package

            $('#create-btn').click(function(e){
                e.preventDefault();

                let actiontype = $('#create-btn').val();
                $(this).html('Sending...');

                if(actiontype === "action-type"){
                    // Do Create

                    $.ajax({
                        url:"{{route('packages.store')}}",
                        type:"POST",
                        dataType:"JSON",
                        data:$('#createform').serialize(),
                        success:function(response){

                            // $('#createform')[0].reset();
                            $('#createform').trigger('reset');

                            $("#createmodal").modal('hide'); //toggle
                            $("#create-btn").html('Save Change');

                            fetchalldatas();

                            Swal.fire({
                                title: "Added!",
                                text: "Added Successfully.",
                                icon: "success"
                            });

                        },
                        error:function(response){
                            console.log('Error : ',response)
                            $("#create-btn").html('Save Change');
                        }
                    })

                }else if(actiontype === "edit-type"){
                    // Do Edit
                    const getid = $("#packageid").val();

                    $.ajax({
                        url:`/packages/${getid}`,
                        type:"PUT",
                        dataType:"json",
                        data:$('#createform').serialize(),
                        success:function(response){

                            // $('#createform')[0].reset();
                            $('#createform').trigger('reset');

                            $("#createmodal").modal('hide'); //toggle
                            $("#create-btn").html('Save Change');

                            fetchalldatas();

                            Swal.fire({
                                title: "Updated!",
                                text: "Updated Successfully.",
                                icon: "success"
                            });

                        },
                        error:function(response){
                            console.log('Error : ',response)
                            $("#create-btn").html('Save Change');
                        }
                    })
                }
            });

            // Start Create & Update Package


            // Start Set Package

            $('#setmodal-btn').click(function(){

                $("#setform").trigger("reset");

                $("#setmodal .modal-title").text("Create Package");
                $("#set-btn").html("Add New Package");
                $("#set-btn").val("action-type");

                $('#setmodal').modal("show"); //toggle
            });

            $('#set-btn').click(function(e){
                e.preventDefault();

                    // Do Set

                    $.ajax({
                        url:"{{route('packages.setpackage')}}",
                        type:"POST",
                        dataType:"JSON",
                        data:$('#setform').serialize(),
                        success:function(response){

                            console.log(response);

                            // $('#createform')[0].reset();
                            $('#setform').trigger('reset');

                            $("#setmodal").modal('hide'); //toggle
                            $("#set-btn").html('Save Change');

                            Swal.fire({
                                title: "Access!",
                                text: "Package Set Successfully.",
                                icon: "success"
                            });

                        },
                        error:function(response){
                            console.log('Error : ',response)
                            $("#set-btn").html('Save Change');
                        }
                    })


            });

            // End Set Package

            // Start Single Delete Item

            // By Ajax
            $(document).on('click','.delete-btns',function(){

                var getid = $(this).data('id');
                var getidx = $(this).data('idx');
                // console.log(getid);

                    Swal.fire({
                            title: "Are you sure?",
                            text: `You won't be able to revert this ${getidx}!`,
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
                                    url:`packages/${getid}`,
                                    type:"DELETE",
                                    dataType:"json",
                                    // data:{_token:"{{csrf_token()}}"},
                                    success:function(response){

                                        if(response){

                                            fetchalldatas();

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

            // End Single Delete Item


        });
    </script>
@endsection

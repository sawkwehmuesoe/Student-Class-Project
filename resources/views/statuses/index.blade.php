@extends('layouts.adminindex')
@section('caption','Status List')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="{{route('statuses.store')}}" method="POST">

                {{ csrf_field() }}

                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <label for="name">First Name <span class="text-danger">*</span></label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" name="name"  id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Name" value="{{old('name')}}" />
                        </div>

                        <div class='col-md-6 mt-3'>

                            <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>

                        </div>

                 </div>

            </form>

        </div>

        <hr/>

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

                <table id="mytable" class="table table-sm table-hover border">
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

                    </tbody>
		        </table>

                <div class="loading">Loading....</div>

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
                                        <label for="editname">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name"  id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter Name" value="{{old('name')}}" />
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

@endsection

@section('css')
<style type="text/css">
    .loading{
        font-weight: bold;

        position: fixed;
        left: 50%;
        top: 50%;

        transform: translate(-50%,-50%);

        display: none;
    }
</style>
@endsection

@section('scripts')

    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            // Start Passing Header Token

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            // End Passing Header Token


            async function fetchalldatas(query=""){

            await $.ajax({

                url:"{{url('api/statusessearch')}}",
                method:"GET",
                type:"JSON",
                data:{"query":query},
                success:function(response){
                    // console.log(response);

                    $("#mytable tbody").empty();
                    $(".loading").hide();

                    const datas = response.data;

                    // console.log(datas);

                    let html;

                    datas.forEach(function(data,idx){
                        // console.log(data);

                        html += `
                                    <tr id="${data.id}">
                                        <td><input type="checkbox" name="singlechecks" class="form-check-input" value="${data.id}" /></td>
                                        <td>${++idx}</td>
                                        <td>${data.name}</td>

                                        <!-- <td>${data.user["name"]}</td> -->
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
                    // $("#mytable tbody").html(html);
                }
            })

            }

            fetchalldatas();

            // Start Filter by search Query

            $('#btn-search').on('click',function(e){
                e.preventDefault();

                const query = $("#filtername").val();
                // console.log(query);

                if(query.length > 0){
                    $(".loading").show();
                }

                fetchalldatas(query);

            });

            // End Filter by search Query

            // start delete item
            $('.delete-btns').click(function(){
                var getidx = $(this).data('idx');

                if(confirm(`Are you sure !!! you want to Delete ${getidx}`)){
                    $('#formdelete-'+getidx).submit();
                    return true;
                }else{
                    return false;
                }
            });

            // end delete item

            // Start Edit Form

            $(document).on('click','.editform',function(e){

                // console.log("hay");

                // console.log($(this).attr('data-id'),$(this).attr('data-name'));

                $('#editname').val($(this).data('name'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/statuses/${getid}`);

                e.preventDefault();

            });

            // End Edit Form


        });




    </script>
@endsection

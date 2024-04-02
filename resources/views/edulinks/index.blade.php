@extends('layouts.adminindex')
@section('caption','Edulinks List')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            @if($getsuccess = session('success'))
                <div class="alert alert-success rounded-0">{{$getsuccess}}</div>
            @endif

            {{-- @if(session('success'))
                <div class="alert alert-success rounded-0">{{session('success')}}</div>
            @endif --}}

        <form action="{{route('edulinks.store')}}" method="POST">
            {{ csrf_field() }}

            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="classdate">Class Date <span class="text-danger">*</span></label>
                        @error('classdate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    <input type="date" name="classdate" id="classdate" class="form-control form-control-sm rounded-0" value="{{old('classdate')}}" />
                </div>

                <div class="col-md-3 form-group">
                    <label for="post_id">Class <span class="text-danger">*</span></label>
                        @error('post_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    <select name="post_id" id="post_id" class="form-control form-control-sm rounded-0">
                        <option selected disabled>Choose class</option>
                        @foreach($posts as $id=>$title)
                            <option value="{{$id}}">{{$title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 form-group">
                    <label for="url">Url Code <span class="text-danger">*</span></label>
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    <input type="text" name="url" id="url" class="form-control form-control-sm rounded-0" placeholder="Enter url" value="{{old('url')}}" />
                </div>

                <div class="col-md-3">
                    <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                </div>

            </div>

        </form>
        </div>

        <hr/>

        {{-- <div class="col-md-12">
            <form action="" method="">
                <div class="row justify-content-end">

                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="filter" id="filter" class="form-control form-control-sm rounded-0" >
                                @foreach($filterposts as $id=>$name)
                                    <option value="{{$id}}" {{$id == request('filter') ? 'selected':''}}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request('search')}}" />
                            <button type="button" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></button>
                            <button type="submit" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}

        <div class="col-md-12">
            <form action="" method="">
                <div class="row justify-content-end">
                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="form-group">
                            <select name="filter" id="filter" class="form-control form-control-sm rounded-0">
                                {{-- <option value="" selected>Choose Status...</option> --}}
                                @foreach ($filterposts as $id => $name)
                                    <option value="{{ $id }}"{{$id == request('filterstauts_id') ? "selected" : ''}}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 mb-2">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request('search')}}" />
                            <button type="button" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></button>
                            <button type="submit" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-md-12">

            <table id="mytable" class="table table-sm table-hover border">
            <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Class</th>
                                            <th>URL</th>
                                            <th>By</th>
                                            <th>Class Date</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($edulinks as $idx=>$edulink)
                                        <tr>
                                            <td>{{$idx+$edulinks->firstItem()}}</td>
                                            <td><a href="{{route('posts.show',$edulink->post_id)}}">{{$edulink->post['title']}}</a></td>
                                            <td><a href="javascript:void(0);" class="link-btns" data-url="{{$edulink->url}}" title="Copy Link">{{Str::limit($edulink->url,30)}}</a></td>
                                            <td>{{$edulink["user"]['name']}}</td>
                                            <td>{{date('d M Y',strtotime($edulink->classdate))}}</td>
                                            <td>{{$edulink->created_at->format('d M Y h:i A')}}</td>
                                            <td>{{$edulink->updated_at->format('d M Y')}}</td>
                                            <td>
                                                <a href="{{$edulink->url}}" class="text-primary" target="_blank" download><i class="fas fa-download"></i></a>
                                                <a href="javascript:void(0);" class="text-info ms-2 editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$edulink->id}}" data-classdate="{{$edulink->classdate}}" data-post={{$edulink->post_id}} data-url="{{$edulink->url}}"><i class="fas fa-pen"></i></a>
                                                <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx + $edulinks->firstItem()}}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                                <form id="formdelete-{{$idx + $edulinks->firstItem()}}" action="{{route('edulinks.destroy',$edulink->id)}}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
            </table>

            {{$edulinks->appends(request()->only('filter'))->links('pagination::bootstrap-4')}}


        </div>

    </div>


	<!-- End Page Content Area -->


    <!-- START MODAL AREA  -->

        <!-- start edit modal  -->
        <div id="editmodal" class="modal fade ">
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

                            <div class="col-md-6 form-group">
                                <label for="editclassdate">Class Date <span class="text-danger">*</span></label>
                                <input type="date" name="editclassdate" id="editclassdate" class="form-control form-control-sm rounded-0" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="editpost_id">Class <span class="text-danger">*</span></label>
                                <select name="editpost_id" id="editpost_id" class="form-control form-control-sm rounded-0">
                                    @foreach($posts as $id=>$title)
                                        <option value="{{$id}}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="editurl">Url <span class="text-danger">*</span></label>
                                <input type="text" name="editurl" id="editurl" class="form-control form-control-sm rounded-0" />
                            </div>

                            <div class="col-md-12 d-flex justify-content-end mt-2">
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
        <!-- end edit modal  -->

    <!-- END MODAL AREA  -->


@endsection

@section('css')
@endsection

@section('scripts')

    <script type="text/javascript">

        // Start Filter
        document.getElementById('filter').addEventListener('click',function(){
            let getfilterid = this.value || this.options[this.selectedIndex].value;
            window.location.href = window.location.href.split('?')[0]+'?filter='+getfilterid;
        });
        // End Filter


        // Start Btn Clear
        document.getElementById('btn-clear').addEventListener('click',function(){
            const getfilter = document.getElementById('filter');
            const getsearch = document.getElementById('search');

            getfilter.selectedIndex = 0;
            getsearch.value = "";

            window.location.href = window.location.href.split("?")[0];

        });
        // End Btn Clear

        // Start Autoshow Btn Clear
        const autoshowbtn = function(){
            let getbtclear = document.getElementById('btn-clear');
            let geturlquery = window.location.search;  //?filter=6&search=9
            // console.log(geturlquery);
            let pattern = /[?&]search=/;

            if(pattern.test(geturlquery)){
                getbtclear.style.display = "block";
            }else{
                getbtclear.style.display = "none";
            }
        };

        autoshowbtn();
        // End Autoshow Btn Clear

        // Start Delete Item
        document.querySelectorAll('.delete-btns').forEach(function(deletebtn){
            deletebtn.addEventListener('click',function(){
                var getidx = this.getAttribute('data-idx');
                // console.log(getidx);

                if(confirm(`Are you sure !!! you want to Delete ${getidx} ?`)){
                    $('#formdelete-'+getidx).submit();
                    return true;
                }else{
                    return fales;
                }

            });
        });
        // End Delete Item

        $(document).ready(function(){

            // Start Edit Form
            $(document).on('click','.editform',function(e){

                $('#editclassdate').val($(this).data('classdate'));
                $('#editpost_id').val($(this).data('post'));
                $('#editurl').val($(this).data('url'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/edulinks/${getid}`);

                e.preventDefault();
            });

            // End Edit Form


            // Start Delete Item
            // $('.delete-btns').click(function(){

            //     var getidx = $(this).data('idx');
            //     // console.log(getidx);

            //     if(confirm(`Are you sure !!! you want to Delete ${getidx} ?`)){
            //         $('#formdelete-'+getidx).submit();
            //         return true;
            //     }else{
            //         return fales;
            //     }

            // });
            // End Delete Item



            // Start link btn
            $('.link-btns').click(function(){
                var geturl = $(this).data('url');
                // console.log(geturl);
                navigator.clipboard.writeText(geturl);
            });
            // End link btn

        });

            </script>
@endsection



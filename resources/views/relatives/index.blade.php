@extends('layouts.adminindex')
@section('caption', 'relatives List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">


        <a href="#createmodal" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal">Create</a>

        <div class="col-md-12">

            <hr />

            <table class="table table-sm table-hover border">
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
                    @foreach ($relatives as $idx => $relative)
                        <tr>
                            <td>{{ ++$idx }}</td>
                            <td>{{ $relative->name }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" {{ $relative->status_id === 3 ? 'checked' : ''}} />
                                </div>
                            </td>
                            <td>{{ $relative['user']['name'] }}</td>
                            <td>{{ $relative->created_at->format('d M Y') }}</td>
                            <td>{{ $relative->updated_at->format('d M Y') }}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{ $relative->id }}" data-name="{{ $relative->name }}" data-status="{{ $relative->status_id }}"><i class="fas fa-pen"></i></a>
                                <a href="#" class="text-danger delete-btns ms-2" data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <form id="formdelete-{{ $idx }}" action="{{ route('relatives.destroy', $relative->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
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
                        <h6 class="modal-title">Create Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('relatives.store')}}" method="POST"> {{--- id="{{route('relatives.store')}}"  --}}

                            {{ csrf_field() }}

                            <div class="row align-items-end">
                                <div class="col-md-7">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-sm rounded-0" placeholder="Enter Name"
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

                                <div class='col-md-2 mt-3'>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0">Submit</button>
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

    {{-- start edit model --}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-0">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Form</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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


@endsection('content')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Start Edit Form

            $(document).on('click','.editform',function(e){

                // console.log($(this).attr('data-id'),$(this).attr('data-name'));

                $('#editname').val($(this).attr('data-name'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/relatives/${getid}`);

                e.preventDefault();

            });

            // End Edit Form
            // Start Delete Item
            $('.delete-btns').click(function() {
                // console.log("hey");
                var getidx = $(this).data('idx');
                // console.log(getidx);

                if (confirm(`Are you sure !!! you want to Delete ${getidx}`)) {
                    $('#formdelete-' + getidx).submit();
                    return true;
                } else {
                    return false;
                }
            })
            // End Delete Item


        });
    </script>
@endsection

@extends('layouts.adminindex')
@section('caption', 'Role List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr />

            <div class="col-md-12">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="form-group">
                                <select name="filterstatus_id" id="filterstatus_id"
                                    class="form-control form-control-sm rounded-0">
                                    {{-- <option value="" selected>Choose Status...</option> --}}
                                    @foreach ($filterstatuses as $id => $name)
                                        <option value="{{ $id }}"{{$id == request('filterstauts_id') ? "selected" : ''}}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">

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
                        @foreach ($roles as $idx => $role)
                            <tr>
                                <td>{{ $idx+ $roles->firstItem() }}</td>
                                <td><img src="{{ asset($role->image) }}" class="rounded-circle" alt="{{ $role->name }}"
                                        width="20" height="20"><a
                                        href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></td>
                                <td>{{ $role->status->name }}</td>
                                <td>{{ $role->user->name }}</td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>{{ $role->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="text-info"><i
                                            class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2"
                                        data-idx="{{ $role->regnumber }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{ $role->regnumber }}"
                                    action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$roles->links('pagination::bootstrap-4')}}
            </div>

        </div>

    </div>

    <!-- End Page Content Area -->

@endsection('content')

@section('scripts')

    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // Start Filter
        const getfilterstatus = document.getElementById('filterstatus_id');

        getfilterstatus.addEventListener('click', function(e) {

            // const getstatusid = this.value;
            const getstatusid = this.value || this.options[this.selectedIndex].value;
            // console.log(getstatusid);

            const getcururl = window.location.href;

            // console.log(getcururl);
            // console.log(getcururl.split('?')); // ['http://example.test/cities', 'filtername=apple']
            // console.log(getcururl.split('?')[0]);

            window.location.href = getcururl.split('?')[0] + '?filterstatus_id=' + getstatusid;
            e.preventDefault();

        })
        // End Filter
        $(document).ready(function() {
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
        });
    </script>
@endsection

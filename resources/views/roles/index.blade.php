@extends('layouts.adminindex')
@section('caption', 'Role List')

@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr />

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
                                <td>{{ ++$idx }}</td>


                                <td>{{ $role->status->name }}</td>
                                <td>{{ $role->user_id }}</td>
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

            </div>

        </div>

    </div>

    <!-- End Page Content Area -->

@endsection('content')

@section('scripts')
    <script type="text/javascript">
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

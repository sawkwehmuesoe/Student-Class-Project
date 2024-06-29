@extends('layouts.adminindex')
@section('content')

    <!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr />

            <div class="col-md-12">

                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Class</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $idx => $announcement)
                        <tr>
                            <td>{{ ++$idx }}</td>
                            <td><img src="{{asset($announcement->image)}}" class="rounded-circle" alt="{{$announcement->name}}" width="20" height="20"><a href="{{route('announcements.show',$announcement->id)}}"> {{ Str::limit($announcement->title,20)}}</a></td>

                            <td><a href="{{route('posts.show',$announcement->post_id)}}">{{$announcement->post['title']}}</a></td>
                                <td>{{ $announcement->user->name }}</td>
                                <td>{{ $announcement->created_at->format('d M Y') }}</td>
                                <td>{{ $announcement->updated_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-info"><i
                                            class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2"
                                        data-idx="{{ $idx }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{ $idx }}"
                                    action="{{ route('announcements.destroy', $announcement->id) }}" method="POST">
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

@endsection

@section('css')
    <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js" type="text/javascript"></script>

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

            });

            // for-mytable
            // let table = new DataTable('#mytable');
            $('#mytable').DataTable();
        });
    </script>
@endsection

@extends('layouts.adminindex')
@section('caption','Student List')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('students.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>

            <hr/>

            <div class="col-md-12">

                <table class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Reg Number</th>
                            <th>Name</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $idx=>$student)
                            <tr>
                                <td>{{++$idx}}</td>
                                <td><a href="{{route('students.show',$student->id)}}">{{$student->regnumber}}</a></td>
                                <td>{{$student->firstname}} {{$student->lastname}}</td>
                                <td>{{Str::limit($student->remark,10)}}</td>
                                <td>{{$student->status_id}}</td>
                                <td>{{$student->user_id}}</td>
                                <td>{{$student->created_at->format('d M Y')}}</td>
                                <td>{{$student->updated_at->format('d M Y')}}</td>
                                <td>
                                    <a href="{{route('students.edit',$student->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="text-danger delete-btns ms-2" data-idx="{{$student->regnumber}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <form id="formdelete-{{$student->regnumber}}" action="{{route('students.destroy',$student->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
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
        $(document).ready(function(){
            $('.delete-btns').click(function(){
                // console.log("hey");
                var getidx = $(this).data('idx');
                // console.log(getidx);

                if(confirm(`Are you sure !!! you want to Delete ${getidx}`)){
                    $('#formdelete-'+getidx).submit();
                }else{
                    return false;
                }
            })
        });
    </script>
@endsection

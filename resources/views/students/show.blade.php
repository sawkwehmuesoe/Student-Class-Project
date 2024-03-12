@extends('layouts.adminindex')
@section('caption','Show Student')

@section('content')

<!-- Start Page Content Area -->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="javascript:void(0)" id="btn-back" class="btn btn-secondary btn-sm rounded-0">Back</a>
            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            <hr/>

            <div class="row">

                <div class="col-md-4 col-lg-3 mb-2">
                    <h6>Info</h6>
                    <div class="card border-0 rouned-0 shadow">

                        <div class="card-body">

                            <div class="d-flex flex-column align-items-center mb-3">
                                <div class="h5 mb-1">{{$student->firstname}} {{$student->lastname}}</div>
                                <div class="text-muted">
                                    <span>{{$student->regnumber}}</span>
                                </div>
                            </div>

                            <div class="w-100 d-flex flex-row justify-content-between mb-3">
                                <button type="button" class="w-100 btn btn-primary btn-sm rounded-0 me-2">Like</button>
                                <button type="button" class="w-100 btn btn-outline-primary btn-sm rounded-0">Follow</button>
                            </div>

                            <div class="mb-5">
                                <div class="row g-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Status</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">{{$student->status['name']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Authorize</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">{{$student['user']['name']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-sm"></i>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Created</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">{{date('d M Y',strtotime($student->updated_at))}} | {{date('h:i:s A',strtotime($student->updated_at))}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-sm"></i>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Updated</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="">{{date('d M Y h:i:s A',strtotime($student->updated_at))}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <p  class="text-small text-muted text-uppercase mb-2">Personal Info</p>
                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <p  class="text-small text-muted text-uppercase mb-2">Contact Info</p>
                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="col">Sample Data</div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-8 col-lg-9">

                    <div class="card-box rounded-0">

                        <ul class="list-group text-center rounded-0">
                            <li class="list-group-item active">Infomation</li>
                        </ul>

                        {{-- start remark --}}
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Remark Here</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$student->remark}}</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- end remark --}}

                    </div>

                </div>

            </div>


        </div>

    </div>

<!-- End Page Content Area -->

@endsection

@section('scripts')
    <script type="text/javascript">
        // Start Back Btn
        const getbtnback = document.getElementById('btn-back');

        getbtnback.addEventListener('click',function(){
            // window.history.back();
            window.history.go(-1);
        });
        // End Back Btn
    </script>
@endsection

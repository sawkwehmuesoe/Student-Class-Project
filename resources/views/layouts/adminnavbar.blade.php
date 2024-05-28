
  <div class="col-lg-10 col-md-9 fixed-top ms-auto topnavbars">
    <div class="row">

        <nav class="nav navbar-expand navbar-light bg-white shadow">

            <!-- search  -->
            <form class="me-auto" action="" method="">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control border-0 shadow-none" placeholder="Search..." />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- search  -->

            <!-- notify & userlogout  -->

            <ul class="navbar-nav me-5 pe-5">
                <!-- notify  -->
                <li class="nav-item dropdowns">
                    <a href="javascript:void(0);" class="nav-line dropbtn" onclick="dropbtn(event)">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                    </a>

                    <div class="dropdown-contents mydropdowns">
                        <a href="javascrip:void(0);" class="small text-muted text-center">Mark all as read</a>

                        @foreach($userdata->unreadNotifications as $notification)
                            <a href="{{route($notification->type == "App\Notifications\AnnouncementNotify" ? 'announcements.show':'leaves.show',$notification->data['id'])}}" class="d-flex">
                                <div class="me-3">
                                    @if($notification->type == "App\Notifications\AnnouncementNotify")
                                    <img src="{{$notification->data['img']}}" class="rounded-circle" width="30" alt="{{$notification->data['id']}}">
                                    @else
                                    <i class="fas fa-bell fa-xs text-primary"></i>
                                    @endif
                                </div>
                                <div class="small">
                                    <ul class="list-unstyled">
                                        @if($notification->type == "App\Notifications\AnnouncementNotify")
                                        <li>{{Str::limit($notification->data["title"],20)}}</li>
                                        <li>{{$notification->created_at->format('d M Y h:i:s A')}}</li>
                                        @else
                                        <li>{{$notification->data['studentid']}}</li>
                                        <li>{{Str::limit($notification->data["title"],20)}}</li>
                                        <li>{{$notification->created_at->format('d M Y h:i:s A')}}</li>
                                        @endif
                                    </ul>
                                </div>
                            </a>
                        @endforeach

                        <a href="javascrip:void(0);" class="small text-muted text-center">Show All Notification</a>
                    </div>
                </li>
                <!-- notify  -->

                <!-- userlogout -->
                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="small text-muted me-2">{{$userdata['name']}}</span>
                        <img src="./assets/img/users/user1.jpg" class="rounded-circle" width="25" />
                    </a>

                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-user fa-sm me-2 text-muted"></i>Profile</a>
                        <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-cogs fa-sm me-2 text-muted"></i>Setting</a>
                        <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-list fa-sm me-2 text-muted"></i>Activity Log</a>
                        <div class="dropdown-divider"></div>
                        {{-- <form method="POST" action="{{ route('logout') }}"> --}}
                            {{-- @csrf --}}

                            {{-- <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit()"><i class="fas fa-sign-out-alt fa-sm me-2 text-muted"></i>Logout</a> --}}
                            {{-- <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); this.parentElement.submit()"><i class="fas fa-sign-out-alt fa-sm me-2 text-muted"></i>Logout</a> --}}
                        {{-- </form> --}}

                        <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit()"><i class="fas fa-sign-out-alt fa-sm me-2 text-muted"></i>Logout</a>
                        <form id="logoutform" action="{{ route('logout') }}" method="POST">@csrf</form>

                    </div>
                </li>
                <!-- userlogout -->
            </ul>

            <!-- notify & userlogout -->
        </nav>

    </div>
</div>

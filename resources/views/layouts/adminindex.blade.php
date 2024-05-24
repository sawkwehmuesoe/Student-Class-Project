@include('layouts.adminheader')

    <div>
        {{-- Start Site Setting  --}}
        <div id="sitesettings" class="sitesettings">
            <div class="settings-item"><a href="javascript:void(0);" id="sitetoggle"></a></div>
        </div>
        {{-- End Site Setting  --}}

        {{-- Start Left Site Bar --}}
        @include('layouts.adminleftsidebar')
        {{-- End Left Site Bar --}}

        {{-- Start Content Area  --}}
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-9 pt-md-5 mt-md-3 ms-auto">
                        {{-- Start Inner Content Area  --}}
                        <div class="row">
                            {{-- <h6>@yield('caption')</h6> --}}
                            {{-- <h6>{{ucfirst(\Request::path())}}</h6> --}}

                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{\Request::root()}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root().'/','',url()->previous())))}}</a></li>
                                    <li class="breadcrumb-item active">{{ucfirst(\Request::path())}}</li>
                                </ol>
                            </nav>



                            @yield('content')
                        </div>
                        {{-- End Inner Content Area  --}}
                    </div>
                </div>
            </div>
        </section>
        {{-- End Content Area  --}}
    </div>


@include('layouts.adminfooter')


{{-- <p>{{\Request::root()}}</p> http://example.test --}}
{{-- <p>{{\Request::fullUrl()}}</p> http://example.test/edulinks?filter=2 --}}
{{-- <p>{{\Request::url()}}</p> http://example.test/edulinks (no query ? / not inc behind ?) --}}
{{-- <p>{{\Request::getRequestUri()}}</p> /edulinks?filter=2 inc all the address behind ? --}}
{{-- <p>{{\Request::getPathInfo()}}</p> /edulinks --}}
{{-- <p>{{\Request::path()}}</p> posts/1/edit --}}

{{-- <p>{{request()->root()}}</p> http://example.test --}}
{{-- <p>{{request()->fullUrl()}}</p> http://example.test/edulinks?filter=2 --}}
{{-- <p>{{request()->url()}}</p> http://example.test/edulinks (no query ? / not inc behind ?) --}}
{{-- <p>{{request()->getRequestUri()}}</p> /edulinks?filter=2 inc all the address behind ? --}}
{{-- <p>{{request()->getPathInfo()}}</p> /edulinks --}}
{{-- <p>{{request()->path()}}</p> posts/1/edit --}}

{{-- <p>{{url()->full()}}</p> http://example.test/edulinks?filter=2 --}}
{{-- <p>{{url()->current()}}</p> http://example.test/edulinks --}}
{{-- <p>{{url()->previous()}}</p> recent link --}}

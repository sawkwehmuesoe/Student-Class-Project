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
                            <h5>@yield('caption')</h5>
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

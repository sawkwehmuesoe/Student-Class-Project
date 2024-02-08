@extends('layouts.adminindex')

@section('content')

<!-- Start Content Area -->

    <div class="container-fluid">
        <div class="col-md-12">
                            <!--Start ShortCut Area  -->
                            <div class="row">

                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-primarys">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Sales (Monthly)</h5>
                                                    <p class="h5 text-muted mb-0">$50,000</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-successes">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Rental Fee (Annual)</h5>
                                                    <p class="h5 text-muted mb-0">$400,000</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-infos">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Debt Collection</h5>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <p class="h5 text-muted mb-0">60%</p>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar bg-info" style="width:60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-warnings">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Request Message</h5>
                                                    <p class="h5 text-muted mb-0">$50,000</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <!-- End ShortCut Area  -->



                            <!-- Start Carousel Area  -->

                            <div class="row">

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="card-title">Sales</h6>
                                            </div>
                                            <div id="sales" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">

                                                    <div class="carousel-item active">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 58,664</h3>
                                                            <h5 class="text danger">+3.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Revenue <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 8,664</h3>
                                                            <h5 class="text danger">+2.3%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Profix <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 58,664</h3>
                                                            <h5 class="text danger">+5.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Netamount <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>

                                                </div>

                                                <button type="button" class="carousel-control-prev" data-bs-target="#sales" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>

                                                <button type="button" class="carousel-control-next" data-bs-target="#sales" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="card-title">Purchases</h6>
                                            </div>
                                            <div id="purchases" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">

                                                    <div class="carousel-item active">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 278,632</h3>
                                                            <h5 class="text danger">+1.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Pre<span class="text-muted">($2172M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 8,664</h3>
                                                            <h5 class="text danger">+2.3%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Profix <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 58,664</h3>
                                                            <h5 class="text danger">+5.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Preorder <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>

                                                </div>

                                                <button type="button" class="carousel-control-prev" data-bs-target="#purchases" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>

                                                <button type="button" class="carousel-control-next" data-bs-target="#purchases" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="card-title">Return</h6>
                                            </div>
                                            <div id="return" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">

                                                    <div class="carousel-item active">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 614</h3>
                                                            <h5 class="text danger">+3.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Expire <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 1,114</h3>
                                                            <h5 class="text danger">+1.1%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">damage <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 58,664</h3>
                                                            <h5 class="text danger">+2.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">Return <span class="text-muted">(1572M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>

                                                </div>

                                                <button type="button" class="carousel-control-prev" data-bs-target="#return" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>

                                                <button type="button" class="carousel-control-next" data-bs-target="#return" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="card-title">Marketing</h6>
                                            </div>
                                            <div id="marketing" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">

                                                    <div class="carousel-item active">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 58,664</h3>
                                                            <h5 class="text danger">+1.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">company <span class="text-muted">(2367 last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 8,664</h3>
                                                            <h5 class="text danger">+2.3%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">outlet <span class="text-muted">(15M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>


                                                    <div class="carousel-item">


                                                        <div class="d-flex">
                                                            <h3 class="me-3">$ 4</h3>
                                                            <h5 class="text danger">+5.2%</h5>
                                                        </div>


                                                        <div class="mb-3">
                                                            <p class="fw-bold text-small">workshop <span class="text-muted">(2M last month)</span></p>
                                                        </div>
                                                        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            <span>June</span>
                                                        </button>

                                                    </div>

                                                </div>

                                                <button type="button" class="carousel-control-prev" data-bs-target="#marketing" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>

                                                <button type="button" class="carousel-control-next" data-bs-target="#marketing" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- End Carousel Area  -->

                            <!--Start ShortCut Area  -->
                            <div class="row pt-md-5 mt-md-3">

                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-primarys">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Rentlal (Monthly)</h5>
                                                    <p class="h5 text-muted mb-0">$50,000</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-successes">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Customer(Annual)</h5>
                                                    <p class="h5 text-muted mb-0">$400,000</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-infos">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Employee</h5>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <p class="h5 text-muted mb-0">60%</p>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar bg-info" style="width:80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 mb-2">
                                    <div class="card shadow py-2 border-left-warnings">
                                        <div class="card-body">
                                            <div class="row align-items-center" >
                                                <div class="col">
                                                    <h5 class="text-xs fw-bold text-primary text-uppercase mb-1">Investor</h5>
                                                    <p class="h5 text-muted mb-0">$40</p>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-secondary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <!-- End ShortCut Area  -->

                            <!-- Start Expenses Area  -->
                            <div class="row mb-4">
                                <div class="col-md-7 mb-3">
                                    <div class="card shadow">
                                        <div class="card-header py-2">
                                            <h6 class="text-primary">Expenses</h6>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="small">Other Expenses<span>20%</span></h4>
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-danger" style="width:20%;" arial-valuenow="20" arial-valuemin="0" arial-valuemax="100"></div>
                                            </div>

                                            <h4 class="small">Sales Tracking<span>40%</span></h4>
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-warning" style="width:40%;" arial-valuenow="40" arial-valuemin="0" arial-valuemax="100"></div>
                                            </div>

                                            <h4 class="small">Rantal Fee<span>60%</span></h4>
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-primary" style="width:60%;" arial-valuenow="60" arial-valuemin="0" arial-valuemax="100"></div>
                                            </div>

                                            <h4 class="small">Salary<span>80%</span></h4>
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-info" style="width:80%;" arial-valuenow="80" arial-valuemin="0" arial-valuemax="100"></div>
                                            </div>

                                            <h4 class="small">Fixture<span>100%</span></h4>
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-success" style="width:100%;" arial-valuenow="100" arial-valuemin="0" arial-valuemax="100"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mb--3">
                                    <div class="card">
                                        <div class="card-header py-2">
                                            <h6 class="text-primary">Revenue Sources</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <canvas id="mypiechart"></canvas>
                                            </div>
                                            <div class="small text-center mt-2 ">
                                                <span><i class="fas fa-circle text-warning"></i>Return Item</span>
                                                <span class="mx-2"><i class="fas fa-circle text-primary"></i>Direct Sales</span>
                                                <span><i class="fas fa-circle text-danger"></i>Online Sales</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Expenses Area  -->

                            <!-- Start Earning Area  -->

                            <div class="row">

                                <div class="col-lg-8 mb-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <h6>Earning Overview</h6>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v fa-sm"></i>
                                                </a>
                                                <div class="dropdown-menu shadow">
                                                    <div class="dropdown-header">Quick Action</div>
                                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0);" class="dropdown-item">View Report</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="curve_chart" style="width:100%;"></div>
                                        </div>
                                    </div>
                                    </div>


                                <div class="col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Regional Team</h5>

                                            <div class="d-flex align-items-center border-bottom py-2">
                                                <img src="./assets/img/users/user1.jpg" class="rounded-circle" width="40" height="40" alt="user1" />
                                                <div class="mb-1 ms-1">
                                                    <h6>Ms. July</h6>
                                                    <small class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i>Mandalay City,Myanmar</small>
                                                </div>
                                                <div class="badge bg-success p-1 ms-auto">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center border-bottom py-2">
                                                <img src="./assets/img/users/user2.jpg" class="rounded-circle" width="40" height="40" alt="user2" />
                                                <div class="mb-1 ms-1">
                                                    <h6>Mr. Anton</h6>
                                                    <small class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i>Yangon City,Myanmar</small>
                                                </div>
                                                <div class="badge bg-success p-1 ms-auto">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center border-bottom py-2">
                                                <img src="./assets/img/users/user3.jpg" class="rounded-circle" width="40" height="40" alt="user3" />
                                                <div class="mb-1 ms-1">
                                                    <h6>Ms. Yoon</h6>
                                                    <small class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i>Bago City,Myanmar</small>
                                                </div>
                                                <div class="badge bg-success p-1 ms-auto">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- End Earnign Area -->

                            <!-- Start Result Area  -->

                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="row">

                                            <div class="col-md-3 col-sm-6">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-users fa-2x text-primary me-4"></i>
                                                        <div class="text-center">
                                                            <p class="text-dark mb-0">Users</p>
                                                            <h5 class="fw-bold text-dark mb-0">56,320</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-check-circle fa-2x text-primary me-4"></i>
                                                        <div class="text-center">
                                                            <p class="text-dark mb-0">Feedback</p>
                                                            <h5 class="fw-bold text-dark mb-0">3200</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-trophy fa-2x text-primary me-4"></i>
                                                        <div class="text-center">
                                                            <p class="text-dark mb-0">Employees</p>
                                                            <h5 class="fw-bold text-dark mb-0">1600</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-star fa-2x text-primary me-4"></i>
                                                        <div class="text-center">
                                                            <p class="text-dark mb-0">Sales</p>
                                                            <h5 class="fw-bold text-dark mb-0">12,860</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- End Result Area  -->

                            <!-- Start Project Status Area -->
                            <div class="row">

                                <div class="col-md-4 mt-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <h5 class="card-title">Sale Analysis Trend</h5>
                                            </div>

                                            <div id="sales-container">

                                            </div>

                                            <!-- <div class="mt-2">
                                                <div class="d-flex justify-content-between">
                                                    <small>Order Value</small>
                                                    <small>120.8%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-secondary" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="mt-2">
                                                <div class="d-flex justify-content-between">
                                                    <small>Total Product</small>
                                                    <small>325.2%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="mt-2">
                                                <div class="d-flex justify-content-between">
                                                    <small>Quantity</small>
                                                    <small>25.60%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div class="card">

                                        <div class="card-body">
                                            <div>
                                                <h5>Project Status</h5>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex ">
                                                                    <img src="./assets/img/clients/client1.png" width="100px" class="img-sm rounded-circle me-2" alt="client1" />
                                                                    <div>
                                                                        <div>Company</div>
                                                                        <div class="fw-bold mt-1">Sony Eletronic</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Sales
                                                                <div class="fw-bold mt-1">$3250</div>
                                                            </td>
                                                            <td>
                                                                Status
                                                                <div class="fw-bold text-success mt-1">88%</div>
                                                            </td>
                                                            <td>
                                                                Deadline
                                                                <div class="fw-bold mt-1">10 June 2023</div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn btn-secondary"><i class="fas fa-pen"></i> edit actions</button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="d-flex ">
                                                                    <img src="./assets/img/clients/client2.png" width="100px" class="img-sm rounded-circle me-2" alt="client2" />
                                                                    <div>
                                                                        <div>Company</div>
                                                                        <div class="fw-bold mt-1">Mi Eletronic</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Sales
                                                                <div class="fw-bold mt-1">$5250</div>
                                                            </td>
                                                            <td>
                                                                Status
                                                                <div class="fw-bold text-success mt-1">78%</div>
                                                            </td>
                                                            <td>
                                                                Deadline
                                                                <div class="fw-bold mt-1">12 June 2023</div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn btn-secondary"><i class="fas fa-pen"></i> edit actions</button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="d-flex ">
                                                                    <img src="./assets/img/clients/client3.png" width="100px" class="img-sm rounded-circle me-2" alt="client3" />
                                                                    <div>
                                                                        <div>Company</div>
                                                                        <div class="fw-bold mt-1">Vivo Eletronic</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Sales
                                                                <div class="fw-bold mt-1">$1250</div>
                                                            </td>
                                                            <td>
                                                                Status
                                                                <div class="fw-bold text-success mt-1">38%</div>
                                                            </td>
                                                            <td>
                                                                Deadline
                                                                <div class="fw-bold mt-1">12 June 2023</div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn btn-secondary"><i class="fas fa-pen"></i> edit actions</button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="d-flex ">
                                                                    <img src="./assets/img/clients/client4.png" width="100px" class="img-sm rounded-circle me-2" alt="client4" />
                                                                    <div>
                                                                        <div>Company</div>
                                                                        <div class="fw-bold mt-1">Oppo Eletronic</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Sales
                                                                <div class="fw-bold mt-1">$5250</div>
                                                            </td>
                                                            <td>
                                                                Status
                                                                <div class="fw-bold text-success mt-1">78%</div>
                                                            </td>
                                                            <td>
                                                                Deadline
                                                                <div class="fw-bold mt-1">15 June 2023</div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn btn-secondary"><i class="fas fa-pen"></i> edit actions</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!-- End Project Status Area -->

                            <!-- Start Todo List Area  -->

                            <div class="row mt-3">

                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="title">Todo List</h4>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v fa-sm"></i></a>
                                                    <div class="dropdown-menu shadow">
                                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                        <a href="javascript:void(0);" class="dropdown-item">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group mt-3">
                                                <input type="text" class="form-control form-control-sm" placeholder="Add List here..." />
                                                <button type="submit" class="btn btn-primary btn-sm form-group">Add to list</button>
                                            </div>

                                            <div>
                                                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                <ul class="list-unstyled">
                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>

                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>

                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>

                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>

                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>

                                                    <li class="d-flex justify-content-between">
                                                        <label>
                                                            <input type="checkbox" class="checkbox" /><span class="ms-2"> when an unknown printer took a galley of type</span>
                                                        </label>
                                                        <i class="fas fa-trash-alt text-muted"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="card">

                                        <div class="card-header">
                                            <h5 class="m-0 text-primary">Illustrations</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="./assets/img/etc/studentgroup.png" class="" style="width:150px;" alt="" />
                                            </div>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s </p>
                                            <a href="javascript:void(0);">Broswe Illustrations on more</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- End Todo List Area  -->
        </div>
    </div>


<!-- End Content Area -->

@endsection('content')

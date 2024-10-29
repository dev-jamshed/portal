@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
      
        <div class="row">
            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Annual Revenue</h5>
                                    <h2 class="mb-3 font-18">{{ $yearlyTotalRevenue }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--<div class="banner-img">-->
                                <!--    <img src="{{ asset('admin/assets/img/banner/1.png') }}" alt="">-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Monthly Revenue</h5>
                                    <h2 class="mb-3 font-18">{{ $monthlySalesRevenue }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--<div class="banner-img">-->
                                <!--    <img src="{{ asset('admin/assets/img/banner/2.png') }}" alt="">-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Open Tickets</h5>
                                    <h2 class="mb-3 font-18">{{ $openTicketsCount }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/banner/4.png') }}" alt="">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">In Progress Tickets</h5>
                                    <h2 class="mb-3 font-18">{{ $progressTicketsCount }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/banner/4.png') }}" alt="">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Closed Tickets</h5>
                                    <h2 class="mb-3 font-18">{{ $closedTicketsCount }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/banner/4.png') }}" alt="">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Employee</h5>
                                    <h2 class="mb-3 font-18">{{ $userCount }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/banner/4.png') }}" alt="">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">clients</h5>
                                    <h2 class="mb-3 font-18">{{ $clients }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--<div class="banner-img">-->
                                <!--    <img src="{{ asset('admin/assets/img/banner/3.png') }}" alt="">-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

        
          
        </div>
    </section>
@endsection


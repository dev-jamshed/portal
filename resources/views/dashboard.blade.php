@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
          @canany('FilterQueries')
                <div class="col-md-3 pl-0 ml-0">
            <div class="form-group filterByUser">
                <label class='pl-1'>Filter By User</label>
                <select class="form-control h-auto " aria-label="filterByUser" id="filterByUser" name="filterByUser"
                    onchange="filterByUser()">

                    <option>All</option>
                   @foreach ($users as $user)
    @if (!auth()->user()->hasRole('Super Admin') && $user->hasRole('Super Admin'))
        @continue
    @endif
    <option value="{{ $user->id }}" {{ $user->id == request('filterByUser') ? 'selected' : '' }}>
        {{ $user->name }}
    </option>
@endforeach



                </select>

            </div>
        </div>
            @endcanany
       
        
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Total Queries</h5>
                                    <h2 class="mb-3 font-18">{{ $totalQueriesCount }}</h2>
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
                                    <h5 class="font-15">Processing Queries</h5>
                                    <h2 class="mb-3 font-18">{{ $processingQueriesCount }}</h2>
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
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Pending Queries</h5>
                                    <h2 class="mb-3 font-18">{{ $pendingQueriesCount }}</h2>
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

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
                                <div class="card-content">
                                    <h5 class="font-15">Complete Queries</h5>
                                    <h2 class="mb-3 font-18">{{ $completeQueriesCount }}</h2>
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
                                    <h5 class="font-15">Avoid Queries</h5>
                                    <h2 class="mb-3 font-18">{{ $avoidQueriesCount }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/void.png') }}" alt="">-->
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
                                    <h5 class="font-15">Avoid Pending</h5>
                                    <h2 class="mb-3 font-18">{{ $avoidQueriesPending }}</h2>
                                </div>
                                <!--</div>-->
                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
                                <!--    <div class="banner-img">-->
                                <!--        <img src="{{ asset('admin/assets/img/void.png') }}" alt="">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
            <!--    <div class="card">-->
            <!--        <div class="card-statistic-4">-->
            <!--            <div class="align-items-center justify-content-between">-->
            <!--                <div class="row ">-->
            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">-->
            <!--                        <div class="card-content">-->
            <!--                            <h5 class="font-15">Rejected Avoid </h5>-->
            <!--                            <h2 class="mb-3 font-18">{{ $rejectedQueriesPending }}</h2>-->
            <!--                        </div>-->
            <!--</div>-->
            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">-->
            <!--    <div class="banner-img">-->
            <!--        <img src="{{ asset('admin/assets/img/void.png') }}" alt="">-->
            <!--    </div>-->
            <!--</div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function filterByUser() {
            const userId = document.getElementById('filterByUser').value;
            window.location.href = `{{ url('dashboard') }}?filterByUser=${userId}`;
        }
    </script>
@endsection

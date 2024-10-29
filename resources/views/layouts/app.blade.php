<!DOCTYPE html>
<html lang="en">
<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend') }}/images/logo.png">
    <meta name="robots" content="no-index, no-follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    <!-- include summernote js-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <link rel="stylesheet" href="{{ asset('admin') }}/assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin') }}/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('admin') }}/assets/img/w11-stop-logo.png' />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">


    <link rel="stylesheet" href="{{ asset('admin/assets/select2/css/select2.min.css') }}">
    <!-- Add these to your <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/css/select2.min.css" rel="stylesheet" />



</head>
@php
    use Illuminate\Support\Str;
@endphp

@php
    use App\Helpers\AttendanceHelper;

    $attendance = AttendanceHelper::getTodayAttendanceForUser(Auth::user()->id);

    // dd($attendance)

@endphp

<body>

    {{-- <div class="loader"></div> --}}
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn">
                                <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        {{-- <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li> --}}
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">

                    @if (isset(Auth::user()->name))
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <span
                                    class='auth-name'>{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}</span>
                                <img alt="image" src="{{ asset('admin') }}/assets/img/user-placeholder.png"
                                    class="user-img-radious-style"> <span
                                    class="d-sm-none d-lg-inline-block"></span></a>
                            <div class="dropdown-menu dropdown-menu-right pullDown">

                                <div class="dropdown-title">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}
                                </div>
                                {{-- <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                                          fa-user"></i> Profile --}}
                                <!-- </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>-->
                                <!--  Activities-->
                                <!--</a>-->
                                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon"> <i
                                        class="fas fa-cog"></i>
                                    Profile Settings
                                </a>



                                @if (
                                    $attendance &&
                                        in_array($attendance->attendance_status, ['present', 'late', 'half_day']) &&
                                        is_null($attendance->out_time))
                                    <a href="{{ route('attendance.checkout') }}"
                                        onclick="event.preventDefault(); document.getElementById('checkout-form').submit();"
                                        class="dropdown-item has-icon">
                                        <i class="fas fa-sign-out-alt"></i> Check-out
                                    </a>
                                    <form id="checkout-form" action="{{ route('attendance.checkout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        <input hidden type="text" name="employee_id" value="{{ Auth::user()->id }}"
                                            required readonly>
                                    </form>
                                @endif

                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                    class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}"> <img class="logo-w11"
                                src="{{ asset('admin') }}/assets/img/w11-stop-logo.png" alt="">
                            {{-- <span
                class="logo-name">Otika</span> --}}
                        </a>
                    </div>
                    <ul class="sidebar-menu">

                        @canany(['view dashboard'])
                        <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        @endcanany

                        @canany(['manage tickets'])
                            <li
                                class="dropdown  {{ request()->routeIs('tickets.index', 'tickets.create', 'tickets.edit') ? 'active' : '' }}">
                                <a href="{{ route('tickets.index') }}" class="nav-link"><i
                                        data-feather="message-square"></i><span>Tickets</span></a>
                            </li>
                        @endcanany



                        @canany(['create-role', 'edit-role', 'delete-role'])
                            <li
                                class="dropdown {{ request()->routeIs('roles.index', 'roles.edit', 'roles.create', 'roles.show') ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}" class="nav-link"><i
                                        data-feather="settings"></i><span>Manage Roles</span></a>
                            </li>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <li
                                class="dropdown {{ request()->routeIs('users.index', 'users.show', 'users.edit', 'users.create') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}" class="nav-link "><i
                                        data-feather="users"></i><span>Manage Users</span></a>
                            </li>
                        @endcanany



                        @canany(['create deparment', 'update deparment', 'delete deparment'])
                            <li
                                class="dropdown {{ request()->routeIs('departments.index', 'departments.edit', 'departments.create', 'departments.show') ? 'active' : '' }}">
                                <a href="{{ route('departments.index') }}" class="nav-link"><i
                                        data-feather="package"></i><span>Manage Departments</span></a>
                            </li>
                        @endcanany


                        @canany(['view subdepartment', 'update subdepartment', 'delete subdepartment'])
                            <li
                                class="dropdown {{ request()->routeIs('subDepartments.index', 'subDepartments.show', 'subDepartments.edit', 'subDepartments.create') ? 'active' : '' }}">
                                <a href="{{ route('subDepartments.index') }}" class="nav-link "><i
                                        data-feather="users"></i><span>Manage Sub Departments</span></a>
                            </li>
                        @endcanany
                        @canany([
                            'create workFromHomePermission',
                            'update workFromHomePermission',
                            'view
                            workFromHomePermission',
                            ])
                            <li
                                class="dropdown {{ request()->routeIs('work_from_home.index', 'work_from_home.edit') ? 'active' : '' }}">
                                <a href="{{ route('work_from_home.index') }}" class="nav-link "><i
                                        data-feather="clock"></i><span>Work From Home</span></a>
                            </li>
                        @endcanany

                        @canany(['manage-schedules'])
                            <li
                                class="dropdown {{ request()->routeIs('schedules.index', 'schedules.edit') ? 'active' : '' }}">
                                <a href="{{ route('schedules.index') }}" class="nav-link "><i
                                        data-feather="calendar"></i><span>Schedules</span></a>
                            </li>
                        @endcanany

                        @canany(['view attendance'])
                            <li class="dropdown {{ request()->routeIs('attendance.index') ? 'active' : '' }}">
                                <a href="{{ route('attendance.index') }}" class="nav-link "><i
                                        data-feather="check"></i><span>Attendances</span></a>
                            </li>
                        @endcanany
                        @canany(['manage-logo-recruitment'])
                            <li class="dropdown {{ request()->routeIs('logoRecruitment.index','logoRecruitment.edit') ? 'active' : '' }}">
                                <a href="{{ route('logoRecruitment.index') }}" class="nav-link "><i
                                        data-feather="figma"></i><span>Logo Recruitment</span></a>
                            </li>
                        @endcanany
                        @canany(['manage-web-recruitment'])
                            <li class="dropdown {{ request()->routeIs('website_requirements.index','website_requirements.edit') ? 'active' : '' }}">
                                <a href="{{ route('website_requirements.index') }}" class="nav-link "><i
                                        data-feather="clipboard"></i><span>Web Recruitment</span></a>
                            </li>
                        @endcanany





                        {{--        <li class="dropdown  {{ request()->routeIs('queries.completedQueries','queries.completedQueries.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('queries.completedQueries') }}"><i data-feather="check-square"></i><span>Completed Queries</span></a>
            </li> --}}




                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
                {{-- <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1"
                                            class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2"
                                            class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1"
                                            class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2"
                                            class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input" id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox"
                                            class="custom-switch-input" id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore
                                -theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    <!--<a href="https://w11stop.com/" target='_blank'>W11Stop -  One Stop, All Solutions </a></a>-->
                    <!--<a href="https://w11stop.com/" target="_blank">W11Stop - One Stop, All Solutions</a>-->
                    <!--<br>-->

                    <span style="font-size: 10px;">Powered by <a href="https://www.diginotive.com"
                            target="_blank">Diginotive.com</a></span>

                </div>
                <div class="footer-right">
                </div>
            </footer>


        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>
    <!-- JS Libraies -->

    <script src="{{ asset('admin') }}/assets/bundles/datatables/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
    </script>
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('admin') }}/assets/bundles/jquery-ui/jquery-ui.min.js"></script>

    <script src="{{ asset('admin') }}/assets/js/page/datatables.js"></script>
    <script src="{{ asset('admin') }}/assets/js/scripts.js"></script>


    <script src="{{ asset('admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('admin') }}/assets/js/custom.js"></script>

    <script src="{{ asset('admin/assets/select2/js/select2.min.js') }}"></script>

    <!-- Add these to your <head> section -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
    <script src="https://cdn.tiny.cloud/1/ip4tafkbma1r2wdwp7slxc7f75lhvuckfqlb1dnwkdl7b4ww/tinymce/6/tinymce.min.js">
    </script>



    @yield('customJs')
</body>


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->

</html>



@if (Auth::check())

    @if ($attendance)
    

        {{-- Check if the attendance record belongs to the logged-in user --}}
        @if ($attendance->uid === Auth::user()->id)
            {{-- Check if the user is required to check-in or check-out --}}
            @if ($attendance->attendance_status === 'absent')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Check-in Required',
                            text: 'Please check-in before proceeding!',
                            icon: 'warning',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showCancelButton: false,
                            confirmButtonText: 'Check-in'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('checkinForm').submit();
                            }
                        });
                    });
                </script>

                {{-- <form id="checkinForm" action="{{ route('attendance.checkin') }}" method="POST">
                    @csrf
                    <input hidden type="text" id="checkin_employee_id" name="employee_id"
                        value="{{ Auth::user()->id }}" required readonly>
                    <button type="submit" class="btn btn-primary">Check-in</button>
                </form> --}}
            {{-- @elseif (
                ($attendance->attendance_status === 'present' ||
                    $attendance->attendance_status === 'late' ||
                    $attendance->attendance_status === 'half_day') &&
                    is_null($attendance->out_time))
                <h2>Check-out</h2>
                <form id="checkoutForm" action="{{ route('attendance.checkout') }}" method="POST">
                    @csrf
                    <input hidden type="text" id="checkout_employee_id" name="employee_id"
                        value="{{ Auth::user()->id }}" required readonly>
                    <button type="submit" class="btn btn-primary">Check-out</button>
                </form> --}}
            @else
                {{-- <p>You are not required to check-in or check-out for today.</p> --}}
            @endif
        @else
            {{-- <p>Attendance data not found for the logged-in user.</p> --}}
        @endif
    @else
       @if ($attendance === null)
      
       <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Check-in Required',
                text: 'Please check-in before proceeding!',
                icon: 'warning',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: false,
                confirmButtonText: 'Check-in'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('checkinForm').submit();
                }
            });
        });
    </script>

    <form id="checkinForm" action="{{ route('attendance.checkin') }}" method="POST">
        @csrf
        <input hidden type="text" id="checkin_employee_id" name="employee_id"
            value="{{ Auth::user()->id }}" required readonly>
        <button type="submit" class="btn btn-primary">Check-in</button>
    </form>
       @endif
    @endif
@else
    {{-- <p>Please log in to access attendance features.</p> --}}
@endif


<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>

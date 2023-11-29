<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title }}</title>
    <link rel="shortcut icon" href="{{ url('/img/gbdoelogo.png') }}">
    <meta name="description" content="Directorate of Education Colleges | EMIS System">
    <meta name="author" content="Directorate of Education Colleges">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables -->
    {{-- <link rel="stylesheet" href="{{ url('/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/buttons.bootstrap4.min.css') }}"> --}}

    <!-- Jquery Confirm -->
    {{-- <link rel="stylesheet" href="{{ url('/css/jquery-confirm.css') }}"> --}}

    <!-- Modals -->
    {{-- <link rel="stylesheet" href="{{ url('/css/toastr.min.css') }}"> --}}

    <!-- Select 2 -->
    {{-- <link rel="stylesheet" href="{{ url('/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/datepicker.css') }}"> --}}

    <!-- Summernote Editor -->
    {{-- <link rel="stylesheet" href="{{ url('/css/summernote-bs4.min.css') }}"> --}}


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/pace.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/pace-theme-flash.css') }}">
    <link rel="stylesheet" href="{{ url('css/icheck-bootstrap.min.css') }}">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="{{ url('css/customstyle.css') }}">
    @livewireStyles
    @powerGridStyles
</head>

<body class="sidebar-collapse sidebar-mini pace-done">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ (auth()->user()->user_role == 1 ? url('admin/dashboard') : auth()->user()->user_role == 2) ? url('institution/dashboard') : url('employee/dashboard') }}"
                        class="nav-link"><span class="fa fa-tachometer-alt"></span>&nbsp;&nbsp;Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block text-danger">
                    <a href="{{ route('users.signout') }}" class="nav-link"><span
                            class="fa fa-lock"></span>&nbsp;&nbsp;Logout</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                @if (auth()->user()->user_role == 6)
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ url('/img/default-prof-img.jpg') }}" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ url('/img/user8-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ url('/img/user3-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                            role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ url('/img/gbdoelogo_white.png') }}" alt="GBDOE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">DOEC EMIS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (auth()->user()->user_role != 2)
                            <img src="{{ url('/img/default-prof-img.jpg') }}"
                                class="img-circle elevation-2" alt="">
                        @else
                            <img src="{{ url('/img/default-prof-img.jpg') }}" />
                        @endif
                    </div>

                    @if (auth()->user()->user_role != 2)
                        <div class="info">
                            <a href="javascript:void(0);"
                                class="d-block">{{ auth()->user()->name }}</a>
                        </div>
                    @else
                        <div class="info">
                            <?php
                            $words = explode(' ', auth()->user()->institution->name);
                            $acronym = '';

                            foreach ($words as $w) {
                                $acronym .= mb_substr($w, 0, 1);
                            }

                            ?>

                            <a href="javascript:void(0);" class="d-block">{{ $acronym }}</a>
                        </div>
                    @endif
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat"
                        data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ (auth()->user()->user_role == 1) ? url('admin/dashboard') : ((auth()->user()->user_role == 2) ? url('institution/dashboard') : url('employee/dashboard')) }}"
                                class="nav-link {{ $selected_sub_menu == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 1)
                            <li class="nav-header">Tools</li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pumps.index') }}" class="nav-link">
                                    <i class="nav-icon far fa fa-lock"></i>
                                    <p class="text">Pumps</p>
                                </a>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'districts' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'districts' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-reader"></i>
                                    <p>
                                        Districts
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'districts_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'districts_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'designations' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'designations' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>
                                        Designations
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'designations_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'designations_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'equipments' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'equipments' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-balance-scale"></i>
                                    <p>
                                        Equipments
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'equipments_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'equipments_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'furnitures' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'furnitures' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        Furnitures
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'furnitures_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'furnitures_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'levels' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'levels' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-balance-scale-right"></i>
                                    <p>
                                        Levels
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'levels_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'levels_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'qualifications' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'qualifications' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chair"></i>
                                    <p>
                                        Qualifications
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'qualifications_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'qualifications_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'subjects' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'subjects' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-mountain"></i>
                                    <p>
                                        Subjects
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'subjects_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'subjects_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'standards' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'standards' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Classes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'standards_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'standards_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'grades' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'grades' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Grades
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'grades_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'grades_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'sessions' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'sessions' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Sessions
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'sessions_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'sessions_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'leave_types' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'leave_types' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bell-slash"></i>
                                    <p>
                                        Leave Types
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'leave_types_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'leave_types_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'buildingcapacities' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'buildingcapacities' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Building Capacities
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'buildingcapacities_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'buildingcapacities_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'quarters' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'quarters' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Budget Quarters
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'quarters_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'quarters_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'budgetheads' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'budgetheads' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-balance-scale-left"></i>
                                    <p>
                                        Budget Heads
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'budgetheads_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'budgetheads_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                class="nav-item {{ $selected_main_menu == 'private_fund_heads' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'private_fund_heads' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-balance-scale-right"></i>
                                    <p>
                                        Private Fund Heads
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'private_fund_heads_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'private_fund_heads_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">Institutions</li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'institutions' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'institutions' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>
                                        Institutions
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'institutions_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View All</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'institutions_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-header">Employees</li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'employees' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'employees' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>
                                        Employees
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'employees_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'employees_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">Reports</li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'reports' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'reports' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-pdf"></i>
                                    <p>
                                        Reports
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'reports_index' ? 'active open' : '' }}">
                                            <i class="fas fa-file-code nav-icon"></i>
                                            <p>Generate</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">Users</li>
                            <li
                                class="nav-item {{ $selected_main_menu == 'users' ? ' menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ $selected_main_menu == 'users' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>
                                        User Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'users_index' ? 'active open' : '' }}">
                                            <i class="far fa-eye nav-icon"></i>
                                            <p>View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href=""
                                            class="nav-link {{ $selected_sub_menu == 'users_create' ? 'active open' : '' }}">
                                            <i class="far fa-plus-square nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif(auth()->user()->user_role == 2)

                        @else

                        @endif
                        <li class="nav-header">Options</li>
                        <li class="nav-item">
                            <a href="{{ route('users.signout') }}" class="nav-link">
                                <i class="nav-icon far fa fa-lock text-danger"></i>
                                <p class="text">Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{ $slot }}
            {{-- @livewire('counter') --}}
            {{-- <livewire::Counter/> --}}
            {{-- @yield('content') --}}
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Powered by <a href="#">The Highlanders Connection</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('/js/jquery.min.js') }}"></script>
    <script src="{{ url('/js/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ url('/js/select2.full.min.js') }}"></script>
    <!-- Form Validations -->
    <script src="{{ url('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('/js/additional-methods.min.js') }}"></script>
    <!-- Jquer Confirm -->

    <script src="{{ url('/js/jquery-confirm.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/js/jszip.min.js') }}"></script>
    <script src="{{ url('/js/pdfmake.min.js') }}"></script>
    <script src="{{ url('/js/vfs_fonts.js') }}"></script>
    <script src="{{ url('/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('/js/buttons.colVis.min.js') }}"></script>
    <!--Modals-->

    <script src="{{ url('/js/toastr.min.js') }}"></script>
    <script src="{{ url('/js/pace.min.js') }}"></script>

    <script src="{{ url('/js/bootstrap-wizard.js') }}"></script>
    <script src="{{ url('/js/inputmask.min.js') }}"></script>
    <script src="{{ url('/js/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('/js/printThis.js') }}"></script>
    <script src="{{ url('/js/datepicker.js') }}"></script>


    <script src="{{ url('/js/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('/js/repeater.js') }}"></script> --}}



    <!-- AdminLTE App -->
    <script src="{{ url('/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('/js/demo.js') }}"></script>

    @stack('scripts')

    @livewireScripts
    @powerGridScripts
</body>

</html>

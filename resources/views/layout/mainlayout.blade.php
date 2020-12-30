<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gutnub</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/e4ccfef97b.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugin/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center overflow-hidden" href="/">
                <img src="{{ asset('img/logo/Gutnub-logo-wborder.png') }}" alt="logo" width="135">
                {{-- <div class="sidebar-brand-text mx-3">Gutnub </div>
                --}}
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homeView') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Project
            </div>

            @forelse ($projectList as $item)
                {{-- <li
                    class="nav-item {{ isset($project) && $project->projectID == $item->projectID ? 'active' : '' }}">
                    <a class="nav-link pb-0" href="{{ route('projectView', ['id' => $item->projectID]) }}">
                        <i class="far fa-file"></i>
                        <span>{{ $item->projectName }}</span>
                    </a>
                </li> --}}

                <li
                    class="nav-item {{ isset($project) && $project->projectID == $item->project->projectID ? 'active' : '' }}">
                    <a class="nav-link pb-0" href="{{ route('projectView', ['id' => $item->project->projectID]) }}">
                        <i class="far fa-file"></i>
                        <span>{{ $item->project->projectName }}</span>
                    </a>
                </li>
            @empty
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_newproject">
                        <i class="fas fa-plus"></i>
                        <span>New project</span>
                    </a>
                </li>
            @endforelse

            <!-- Nav Item - Pages Collapse Menu -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ Auth::user()->profilePicture }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Gutnub 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/js/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('plugin/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugin/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>

    @yield('script')
</body>

</html>

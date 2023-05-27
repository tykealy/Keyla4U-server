<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('css/style2.css')}}" rel="stylesheet" />
         <!-- base:css -->
        <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/dashboard">
                <b>Keyla4U</b>
                <img id="old-image" src="{{ asset('./img/white-logo.png') }}" alt="Image" width="50px">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown12" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown12">
                        <li><a href="{{route('profile.edit')}}" class="text-decoration-none text-dark ms-4">Profile</a></li>
                        <li>
                             <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" :class="'text-decoration-none text-dark'"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                  Logout
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading text-success">Core</div>
                            <a class="nav-link text-light" href="/">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house text-info"></i></div>
                                Home
                            </a>
                            <a class="nav-link text-light" href="{{route('profile.edit')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user text-info"></i></div>
                                Profile
                            </a>
                            <div class="sb-sidenav-menu-heading text-success">Interface</div>
                            <a class="nav-link text-light" href="{{ route('admin_register') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user text-info"></i></div>
                                Create acoount
                            </a>
                            <a class="nav-link text-light" href="{{route('clubs.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user text-info"></i></div>
                                Club
                            </a>
                            <a class="nav-link text-light" href="{{route('user.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user text-info"></i></div>
                                User
                            </a>
                            
                            <div class="sb-sidenav-menu-heading text-success">Addons</div>
                            <a class="nav-link text-light" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area text-info"></i></div>
                                Charts
                            </a>
                            <a class="nav-link text-light" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-table text-info"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small text-light">Logged in as:super admin</div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
        <script src="{{asset('js/scripts.js')}}"></script>

            {{-- <!-- base:js -->
        <script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{asset('js/template.js')}}"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        <!-- End plugin js for this page -->
        <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>
            <script src="{{asset('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')}}"></script>
            <script src="{{asset('vendors/justgage/raphael-2.1.4.min.js')}}"></script>
            <script src="{{asset('vendors/justgage/justgage.js')}}"></script>
        <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
        <!-- Custom js for this page-->
        <script src="{{asset('js/dashboard.js')}}"></script> --}}

    </body>
</html>

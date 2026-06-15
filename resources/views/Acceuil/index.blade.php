@extends('layouts.app1')
@section('wrapper2')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Eleves</h4>
                                <p class="text-muted mb-0">
                                    Gestion des élèves
                                    Créer, modifier, archiver les dossiers des élèves </p>
                            </div>
                            <div class="card-body">
                                <!-- Standard modal content -->
                                {{-- <!-- /.modal --> --}}

                                {{-- eleves option de modal --}}
                                <div class="d-flex flex-wrap gap-2">
                                    <!--Ajout d'eleves -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#standard-modal"><a href="{{ route('eleves.create') }}" style="color: white">Ajouter eleves</a></button>
                                    <!-- Liste des eleves -->
                                    <button type="button" class="btn btn-info" ><a href="{{ route('eleves.liste') }}" style="color: white">Liste des eleves</a></button>
                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-success" ><a href="#" style="color: white">Archiver eleves</a></button>

                                </div>
                            </div>
                            <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Inscription</h4>
                                <p class="text-muted mb-0">Suivie des inscription par année et les statuts</p>
                            </div>
                            <div class="card-body">
                                <!-- Signup modal content -->
                                <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                                                    <a href="index.html" class="logo-dark">
                                                        <span><img src="assets/images/logo-dark.png" alt="dark logo"
                                                                height="22"></span>
                                                    </a>
                                                    <a href="index.html" class="logo-light">
                                                        <span><img src="{{ asset('assets/images/logo.png') }}"
                                                                alt="logo" height="22"></span>
                                                    </a>
                                                </div>

                                                <form class="ps-3 pe-3" action="#">

                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Année</label>
                                                        <select name="year" id="year" class="form-control">
                                                            <option value="">Sélectionnez une année</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                        </select>
                                                    </div>

                                                    {{-- <div class="mb-3">
                                                        <label for="emailaddress" class="form-label">Email address</label>
                                                        <input class="form-control" type="email" id="emailaddress"
                                                            required="" placeholder="john@deo.com">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input class="form-control" type="password" required=""
                                                            id="password" placeholder="Enter your password">
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">I accept <a
                                                                    href="#">Terms and Conditions</a></label>
                                                        </div>
                                                    </div> --}}

                                                    <div class="mb-3 text-center">
                                                        <button class="btn btn-primary" type="submit">liste des inscrits</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->


                                <!-- SignIn modal content -->
                                <div id="login-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                                                    <a href="index.html" class="logo-dark">
                                                        <span><img src="assets/images/logo-dark.png" alt="dark logo"
                                                                height="22"></span>
                                                    </a>
                                                    <a href="index.html" class="logo-light">
                                                        <span><img src="{{ asset('assets/images/logo.png') }}"
                                                                alt="logo" height="22"></span>
                                                    </a>
                                                </div>

                                                <form action="#" class="ps-3 pe-3">
                                                    <div class="mb-3">
                                                        <label for="emailaddress1" class="form-label">Email
                                                            address</label>
                                                        <input class="form-control" type="email" id="emailaddress1"
                                                            required="" placeholder="john@deo.com">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password1" class="form-label">Password</label>
                                                        <input class="form-control" type="password" required=""
                                                            id="password1" placeholder="Enter your password">
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck2">
                                                            <label class="form-check-label" for="customCheck2">Remember
                                                                me</label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 text-center">
                                                        <button class="btn rounded-pill btn-primary" type="submit">Sign
                                                            In</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Sign Up modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#signup-modal">Listes des inscrits</button>
                                    <!-- Log In modal -->
                                    <button type="button" class="btn btn-info" type="submit" http="#" >valider les inscriptions</button>
                                </div>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Traiter les inscriptions</h4>
                                <p class="text-muted mb-0">
                                    Gestions des inscriptions des eleves de l'établissement
                                </p>
                            </div>
                            <div class="card-body">

                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Primary header modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#primary-header-modal">Incriptions en cour</button>
                                    <!-- Success header modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#success-header-modal">Inscriptions validées</button>
                                    <!-- Info header modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#info-header-modal">Inscriptions annulées</button>
                                    <!-- Warning header modal -->
                                    {{-- <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#warning-header-modal">Warning Header</button> --}}
                                    <!-- Danger header modal -->
                                    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#danger-header-modal">Danger Header</button> --}}
                                    <!-- Pink header modal -->
                                    {{-- <button type="button" class="btn btn-pink" data-bs-toggle="modal"
                                        data-bs-target="#pink-header-modal">Pink Header</button> --}}
                                    <!-- Purple header modal -->
                                    {{-- <button type="button" class="btn btn-purple" data-bs-toggle="modal"
                                        data-bs-target="#purple-header-modal">Purple Header</button> --}}
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Les classes</h4>
                                <p class="text-muted mb-0">Gestions des classes de l'établissement</p>
                            </div>
                            <div class="card-body">

                                <!-- Success Filled Modal -->
                                <div id="fill-success-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="fill-success-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content modal-filled bg-success">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="fill-success-modalLabel">Success Filled Modal
                                                </h4>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio,
                                                    dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                                    Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-outline-light">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!-- Info Filled Modal -->
                                <div id="fill-info-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="fill-info-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content modal-filled bg-info">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="fill-info-modalLabel">Info Filled Modal</h4>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio,
                                                    dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                                    Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-outline-light">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->




                                <!-- Danger Filled Modal -->
                                <div id="fill-purple-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="fill-purple-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content modal-filled bg-purple">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="fill-purple-modalLabel">Les classe
                                                </h4>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Gestions des classes de l'etablissement
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-outline-light">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->


                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Primary header modal -->
                                    <button type="button" class="btn btn-primary" > <a href="{{ route('liste_classes') }}" style="color: white">liste des classe</a></button>
                                    <!-- Success header modal -->
                                    <button type="submit" class="btn btn-success"  ><a href="{{ route('ajouter_classe') }}" style="color: white">Ajouter une classe</a> </button>
                                    <!-- Info header modal -->


                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

            </div> <!-- container -->

        </div> <!-- content -->


    </div>
@endsection
@section('contenue')
    <!-- ============================================================== -->
    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="p-3">
                    <h5 class="mb-3 fs-16 fw-semibold">Color Scheme</h5>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-bs-theme"
                                    id="layout-color-light" value="light">
                                <label class="form-check-label" for="layout-color-light">Light</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-bs-theme"
                                    id="layout-color-dark" value="dark">
                                <label class="form-check-label" for="layout-color-dark">Dark</label>
                            </div>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h5 class="my-3 fs-16 fw-semibold">Layout Mode</h5>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-layout-mode" id="layout-mode-fluid" value="fluid">
                                    <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div id="layout-boxed">
                                    <div class="form-check mb-1">
                                        <input class="form-check-input border-secondary" type="radio"
                                            name="data-layout-mode" id="layout-mode-boxed" value="boxed">
                                        <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-3 fs-16 fw-semibold">Topbar Color</h5>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio"
                                    name="data-topbar-color" id="topbar-color-light" value="light">
                                <label class="form-check-label" for="topbar-color-light">Light</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio"
                                    name="data-topbar-color" id="topbar-color-dark" value="dark">
                                <label class="form-check-label" for="topbar-color-dark">Dark</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 fs-16 fw-semibold">Menu Color</h5>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-menu-color" id="leftbar-color-light" value="light">
                                    <label class="form-check-label" for="leftbar-color-light">Light</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-menu-color" id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 fs-16 fw-semibold">Sidebar Size</h5>

                        <div class="row gap-2">
                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-sidenav-size" id="leftbar-size-default" value="default">
                                    <label class="form-check-label" for="leftbar-size-default">Default</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                    <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio"
                                        name="data-sidenav-size" id="leftbar-size-full" value="full">
                                    <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 fs-16 fw-semibold">Layout Position</h5>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="data-layout-position"
                                        id="layout-position-fixed" value="fixed">
                                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="data-layout-position"
                                        id="layout-position-scrollable" value="scrollable">
                                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
@endsection

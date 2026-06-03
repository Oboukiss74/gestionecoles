@extends('layouts.app')
@section('wrapper2')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- end row-->

                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color: rgb(36, 247, 180)0, 255, 174)">

                                <p class="text-muted mb-0">
                                    L'inscription est unique pour chaque élève, elle doit être faite une seule fois pour
                                    chaque élève.
                                </p>
                            </div>
                            <form action="#" method="post">
                                @csrf
                                <div class="card-body">
                                    afficher les informations de l'eleve pour confirmer l'inscription
                                    @foreach ($eleve as $eleves)
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker1">
                                                    <label class="form-label">nom</label>
                                                    <input type="text" class="form-control" value="{{ $eleves->nom }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">prenom</label>
                                                    <input type="text" class="form-control" value="{{ $eleves->prenom }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker3">
                                                    <label class="form-label">Matricule</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $eleves->matricule }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker4">
                                                    <label class="form-label">Sexe</label>
                                                    <input type="text" class="form-control" value="{{ $eleves->sexe }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker5">
                                                    <label class="form-label    ">Date de naissance</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $eleves->date_naissance }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker6">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="{{ $eleves->email }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker5">
                                                    <label class="form-label">Classe</label>
                                                    <input type="text" class="form-control" value="classe" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker6">
                                                    <label class="form-label">Année academique</label>
                                                    <input type="text" class="form-control" value="Annee scolaire"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker5">
                                                    <label class="form-label">Telephone</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $eleves->telephone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3 position-relative" id="datepicker6">
                                                    <label class="form-label">Residence</label>
                                                    <input type="text" class="form-control" value="residence">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <button type="button" class="btn btn-primary">Enregistrer</button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </form>
                            <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                {{-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=".card-title">Typeahead</h4>
                                    <p class="text-muted mb-0">
                                        Typeahead.js is a fast and fully-featured autocomplete library.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">The Basics</label>
                                                <input type="text" class="form-control"
                                                    data-provide="typeahead" id="the-basics"
                                                    value="Basic Example">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Bloodhound (Suggestion Engine)</label>
                                                <input id="bloodhound" class="form-control" type="text"
                                                    value="States of USA">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Prefetch</label>
                                                <input type="text" class="form-control"
                                                    data-provide="typeahead" id="prefetch"
                                                    value="States of USA">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Remote</label>
                                                <input type="text" class="form-control"
                                                    data-provide="typeahead" id="remote"
                                                    value="States of USA">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Custom Templates</label>
                                                <input id="custom-templates" class="form-control" type="text"
                                                    value="States of USA">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Default Suggestions</label>
                                                <input type="text" class="form-control"
                                                    data-provide="typeahead" id="default-suggestions">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-0">
                                                <label class="form-label">Multiple Datasets</label>
                                                <input type="text" class="form-control"
                                                    data-provide="typeahead" id="multiple-datasets">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div> --}}
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

    </div>
@endsection
<!-- END wrapper -->
@section('contenue')
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
                                <input class="form-check-input border-secondary" type="radio" name="data-topbar-color"
                                    id="topbar-color-light" value="light">
                                <label class="form-check-label" for="topbar-color-light">Light</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-topbar-color"
                                    id="topbar-color-dark" value="dark">
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

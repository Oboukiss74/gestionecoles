@extends('layouts.app1')
@section('wrapper2')
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{ route('eleves.storeNouveau') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=".card-title">Nouveau élève CP1</h4>
                                    <p class="text-muted mb-0">
                                        veuillez remplir le formulaire ci-dessous pour vous inscrire en tant qu'élève dans
                                        notre
                                        école.
                                        Nous avons besoin de ces informations pour créer votre compte et vous permettre
                                        d'accéder à nos services éducatifs.
                                        Assurez-vous de fournir des informations précises et complètes.
                                    </p>
                                </div>
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Nom</label>
                                        <input type="text" class="form-control" id="validationCustom01" placeholder="Nom"
                                            required name="nom" style="text-transform: uppercase;">
                                        {{-- <div class="valid-feedback">
                                            Looks good!
                                        </div> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Prénom</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            placeholder="Prénom" required name="prenom">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustomUsername">Sexe</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                            <select name="sexe" class="form-control" id="validationCustomUsername">
                                                <option value="">Sélectionnez votre sexe</option>
                                                <option value="M">Homme</option>
                                                <option value="F">Femme</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom03">Nationalité</label>
                                        <input type="text" class="form-control" id="validationCustom03"
                                            placeholder="Nationalité" required name="nationalite">
                                        {{-- <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Telephone</label>
                                        <input type="text" class="form-control" id="validationCustom04"
                                            placeholder="Telephone" required name="telephone">
                                        {{-- <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Email</label>
                                        <input type="email" class="form-control" id="validationCustom05"
                                            placeholder="Email" required name="email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustomDob">Date de naissance</label>
                                        <input type="date" class="form-control" id="validationCustomDob" required
                                            name="date_naissance">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustomDob">Lieu de naissance</label>
                                        <input type="text" class="form-control" id="validationCustomDob" required
                                            name="lieu_naissance">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustomClasse">Classe</label>
                                        <select name="classe_id" class="form-control" id="validationCustomClasse" required>
                                            <option value="">Sélectionnez une classe</option>
                                            @foreach ($niveau as $niveaux)
                                                <option value="{{ $niveaux->id }}">{{ $niveaux->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">photo</label>
                                        <input type="file" class="form-control" id="validationCustom05"
                                            placeholder="photo" required name="photos">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Nom du pere/mere</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            placeholder="Nom du pere/mere" required name="nom_parent">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">prenom du pere/mere</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            placeholder="Prenom du pere/mere" required name="prenom_parent">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Lieu de residence</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            placeholder="Lieu de residence" required name="residence_parent">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Numero parents</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            placeholder="Numero parents" required name="telephone_parent">
                                    </div>

                                    {{-- <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">2é Numero des parents</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Numero des parents" required name="parent_id">

                                    </div> --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">profession du
                                            pere/mere</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            placeholder="profession" required name="profession_parent">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom05">Email du pere/mere</label>
                                        <input type="email" class="form-control" id="validationCustom05"
                                            placeholder="Email du pere/mere" required name="email_parent">
                                    </div>


                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                            <label class="form-check-label form-label" for="invalidCheck">j'accepte
                                                les
                                                termes et conditions</label>

                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Enregistrer</button>


                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="{{ route('eleves.store.ancien') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=".card-title">Eleves venant d'autres ecoles ou anciens élèves</h4>
                                    <p class="text-muted mb-0">
                                        Si vous êtes un élève venant d'une autre école et que vous souhaitez rejoindre notre
                                        établissement, veuillez remplir le formulaire ci-dessous.
                                        Nous avons besoin de ces informations pour faciliter votre transition et assurer une
                                        intégration harmonieuse dans notre communauté scolaire.

                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip01">nom</label>
                                        <input type="text" class="form-control" id="validationTooltip01"
                                            placeholder="votre nom" required name="nom">


                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip02">Prénom</label>
                                        <input type="text" class="form-control" id="validationTooltip02"
                                            placeholder="Prénom" required name="prenom">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip02">Date de naissance</label>
                                        <input type="date" class="form-control" id="validationTooltip02"
                                            placeholder="Date de naissance" required name="date_naissance">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip02">Lieu de naissance</label>
                                        <input type="text" class="form-control" id="validationTooltip02"
                                            placeholder="Lieu de naissance" required name="lieu_naissance">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltipUsername">Nationalité</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span> --}}
                                            <input type="text" class="form-control" id="validationTooltipUsername"
                                                placeholder="Nationalité"
                                                aria-describedby="validationTooltipUsernamePrepend" required
                                                name="nationalite">

                                        </div>
                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip03">Sexe</label>
                                        <select name="sexe" class="form-control" id="validationTooltip03">
                                            <option value="">Sélectionnez votre sexe</option>
                                            <option value="M">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>

                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip03">Niveau suivant</label>
                                        <select name="classe_id" class="form-control" id="validationTooltip03">
                                            <option value="">Sélectionnez le niveau suivant</option>
                                            @foreach ($niveau as $niveaux)
                                                <option value="{{ $niveaux->id }}">{{ $niveaux->nom }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip04">Telephone</label>
                                        <input type="text" class="form-control" id="validationTooltip04"
                                            placeholder="Telephone" required name="telephone">

                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip04">Email</label>
                                        <input type="email" class="form-control" id="validationTooltip04"
                                            placeholder="Email" required name="email">

                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">Classe demandée</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Classe demandée" required name="classe_demandee">
                                    </div>
                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">Ancienne école</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Ancienne école" required name="ancienne_ecole">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">Matricule</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Matricule" required name="matricule">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">photo</label>
                                        <input type="file" class="form-control" id="validationTooltip05"
                                            placeholder="photo" name="photo">

                                    </div>

                                    <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">Numero des parents</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Numero des parents" required name="telephone_parent">

                                    </div>

                                    {{-- <div class="position-relative mb-3">
                                        <label class="form-label" for="validationTooltip05">2é Numero des parents</label>
                                        <input type="text" class="form-control" id="validationTooltip05"
                                            placeholder="Numero des parents" required name="parent_id">

                                    </div> --}}
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                            <label class="form-check-label form-label" for="invalidCheck">j'accepte
                                                les
                                                termes et conditions</label>

                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </form>
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Techmin - Theme by <b>Techzaa</b>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection
@section('contenue')
    <!-- END wrapper -->

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

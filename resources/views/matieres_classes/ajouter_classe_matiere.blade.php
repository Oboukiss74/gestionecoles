@extends('layouts.app1')
@section('wrapper2')
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    {{-- message de succès --}}

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid" style="">

                <div class="row">



                    <div class="col-lg-6" style="transform: translate(55%, 10px);">
                        <div class="card">
                            @if (session('successclasse'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('successclasse') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-header">
                                <h4 class=".card-title">Ajout des classes</h4>
                                {{-- <p class="text-muted mb-0">


                                </p> --}}
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="post" action="{{ route('enregistrer_matiere') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom de la matière</label>
                                        {{-- <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required> --}}
                                        <select name="nom" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                                            <option value="">Sélectionner une matière</option>
                                            <option value="Français">Français</option>
                                            <option value="Mathématiques">Mathématiques</option>
                                            <option value="Histoire">Histoire</option>
                                            <option value="Géographie">Géographie</option>
                                            {{-- @foreach ($matieres as $matiere)
                                                <option value="{{ $matiere->id }}" {{ old('nom') == $matiere->id ? 'selected' : '' }}>
                                                    {{ $matiere->nom }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="coefficient" class="form-label">Coefficient</label>
                                        <input type="number" class="form-control" id="coefficient" name="coefficient" value="{{ old('coefficient') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Niveau de classe</label>
                                        <select id="niveauSelect" class="form-select" name="niveau" required>
                                            <option value="">Sélectionner un niveau</option>
                                            <option value="Primaire">Primaire</option>
                                            <option value="Secondaire">Secondaire</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label mb-0">Classes concernées</label>
                                            <button type="button" id="filterClassesBtn" class="btn btn-sm btn-outline-secondary">Afficher les classes</button>
                                        </div>

                                        @if ($classes->isEmpty())
                                            <p class="text-muted mb-0">Aucune classe n’est disponible pour le moment.</p>
                                        @else
                                            <div id="noClassMessage" class="text-muted mb-2" style="display:none;">Aucune classe ne correspond à ce niveau.</div>
                                            <div class="row" id="classesContainer">
                                                @foreach ($classes as $classe)
                                                    <div class="col-md-4 mb-2 class-item" data-niveau="{{ strtolower($classe->niveau) }}" style="display:none;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="classe_id[]" value="{{ $classe->id }}" id="classe_{{ $classe->id }}" {{ in_array($classe->id, old('classe_id', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="classe_{{ $classe->id }}">
                                                                {{ $classe->nom }} ({{ $classe->niveau }})
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                                </form>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const niveauSelect = document.getElementById('niveauSelect');
            const filterBtn = document.getElementById('filterClassesBtn');
            const classItems = document.querySelectorAll('.class-item');
            const noClassMessage = document.getElementById('noClassMessage');

            if (filterBtn && niveauSelect) {
                filterBtn.addEventListener('click', function () {
                    const niveau = (niveauSelect.value || '').toLowerCase();
                    let visibleCount = 0;

                    classItems.forEach(function (item) {
                        const itemNiveau = (item.getAttribute('data-niveau') || '').toLowerCase();
                        const shouldShow = !niveau || itemNiveau === niveau;
                        item.style.display = shouldShow ? 'block' : 'none';
                        if (shouldShow) {
                            visibleCount++;
                        }
                    });

                    if (noClassMessage) {
                        noClassMessage.style.display = visibleCount > 0 ? 'none' : 'block';
                    }
                });
            }
        });
    </script>

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
{{-- les js --}}
@section('js')
@endsection

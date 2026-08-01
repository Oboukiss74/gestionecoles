@extends('layouts.app1')

@section('wrapper2')

<div class="account-pages p-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-9 col-lg-11">

                <div class="card overflow-hidden">
                    <div class="row g-0">

                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">

                                <div class="auth-brand p-4 text-center">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="28">
                                    </a>
                                </div>


                                {{-- Message succès --}}
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif


                                {{-- Message erreur personnalisé --}}
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif


                                {{-- Erreurs de validation Laravel --}}
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif



                                <div class="p-4 my-auto">

                                    <p class="text-muted text-center mb-4">
                                        Ouverture de session d'inscription pour les élèves.
                                    </p>


                                    <form action="{{ route('programmer.inscription.store') }}" method="POST">

                                        @csrf


                                        {{-- Année scolaire automatique --}}
                                        <div class="mb-3">

                                            <input type="hidden"
                                                   name="annee_scolaire_id"
                                                   value="{{ $anneeActive->id ?? '' }}">
                                        </div>



                                        {{-- Libelle --}}
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Libellé
                                            </label>


                                            <input type="text"
                                                   class="form-control @error('libelle') is-invalid @enderror"
                                                   name="libelle"
                                                   value="{{ old('libelle', $anneeActive->libelle ?? '') }}">


                                            @error('libelle')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>




                                        {{-- Date début --}}
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Date de début
                                            </label>


                                            <input type="date"
                                                   class="form-control @error('date_debut') is-invalid @enderror"
                                                   name="date_debut"
                                                   value="{{ old('date_debut') }}">


                                            @error('date_debut')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>




                                        {{-- Date fin --}}
                                        <div class="mb-3">

                                            <label class="form-label">
                                                Date de fin
                                            </label>


                                            <input type="date"
                                                   class="form-control @error('date_fin') is-invalid @enderror"
                                                   name="date_fin"
                                                   value="{{ old('date_fin') }}">


                                            @error('date_fin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>



                                        <div class="d-grid text-center">
                                            <button class="btn btn-primary fw-semibold" type="submit">
                                                Ouvrir
                                            </button>
                                        </div>


                                    </form>

                                </div>

                            </div>
                        </div>



                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="{{ asset('assets/images/auth-img.jpg') }}"
                                 class="img-fluid rounded h-100">
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
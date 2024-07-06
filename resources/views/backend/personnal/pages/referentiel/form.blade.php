@extends('backend.admin.home')

@section('title', $referentiel->exists ? "Edition d'un referentiel": "Enregistrement d'un referentiel")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.referentiel.index')}}">Liste des referentiels</a></li>
        <li class="breadcrumb-item active"> @if ($referentiel->exists)
            Modification                
        @else
            Enregistrement
        @endif</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card mt-2">
    <div class="card-body col-lg-10 m-auto">
        <form class="vstack mt-4  gap-2" action="{{ route($referentiel->exists ? 'admin.referentiel.update': 'admin.referentiel.store', $referentiel) }}" method="post" enctype="multipart/form-data">

            @method($referentiel->exists ? 'put' : 'post')
            @csrf

            <div class="row ">
                <div class="col-md-6 col-sm-6 col-sm-12  mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="floatingnom" placeholder="nom" value="{{old('nom', $referentiel->nom)}}">
                        <label for="floatingnom">Nom du referentiel</label>
                        <div class="invalid-feedback">@error('nom') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('pdf') is-invalid @enderror" type="file" name="pdf" id="floatingpdf" placeholder="pdf" value="{{old('pdf', $referentiel->pdf)}}">
                        <label for="floatingpdf">Document PDF</label>
                        <div class="invalid-feedback">@error('pdf') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="row gap-3">              
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($referentiel->id) Modifier
                        @else Enregistrer
                        @endif
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
    
@endsection
    
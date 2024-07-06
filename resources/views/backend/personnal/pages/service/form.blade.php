@extends('backend.admin.home')

@section('title', $service->exists ? "Edition d'un service": "Enregistrement services / Départments")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.service.index')}}">Liste services</a></li>
        <li class="breadcrumb-item active"> @if ($service->exists)
            Modification                
        @else
            Enregistrement
        @endif</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card">
    <div class="card-body col-lg-10 m-auto">
        <form class="vstack mt-4 gap-2" action="{{ route($service->exists ? 'admin.service.update': 'admin.service.store', $service) }}" method="post" enctype="multipart/form-data">

            @method($service->exists ? 'put' : 'post')
            @csrf

            <div class="row gap-2 ">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="floatingnom" placeholder="nom" value="{{old('nom', $service->nom)}}">
                        <label for="floatingnom">Nom du service</label>
                        <div class="invalid-feedback">@error('nom') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('abreger') is-invalid @enderror" type="text" name="abreger" id="floatingabreger" placeholder="abreger" value="{{old('abreger', $service->abreger)}}">
                        <label for="floatingabreger">Sigle</label>
                        <div class="invalid-feedback">@error('abreger') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($service->id) Modifier
                        @else Enregistrer
                        @endif
                    </button>
                </div>
            </div>

            <div></div>
        </form>
    </div>
</div>
    
@endsection
    
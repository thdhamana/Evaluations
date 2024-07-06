@extends('backend.admin.home')

@section('title', $domaine->exists ? "Edition d'un domaine": "Enregistrement d'un domaine")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.domaine.index')}}">Liste des domaines</a></li>
        <li class="breadcrumb-item active"> @if ($domaine->exists)
            Modification                
        @else
            Enregistrement
        @endif</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card mt-2">
    <div class="card-body col-lg-10 m-auto">
        <form class="vstack mt-4  gap-2" action="{{ route($domaine->exists ? 'admin.domaine.update': 'admin.domaine.store', $domaine) }}" method="post" enctype="multipart/form-data">

            @method($domaine->exists ? 'put' : 'post')
            @csrf

            <div class="row ">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="floatingnom" placeholder="nom" value="{{old('nom', $domaine->nom)}}">
                        <label for="floatingnom">Nom du domaine</label>
                        <div class="invalid-feedback">@error('nom') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="row gap-3">
                <div class="col-lg-12 col-md-12 mt-2">
                    <div class="form-floating">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 80px">{{ old('description', $domaine->description) }}</textarea>
                        <label for="floatingTextarea2">Une petite description</label>
                        <div class="invalid-feedback">@error('description') {{ $message }} @enderror</div>
                    </div>
                </div>                
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($domaine->id) Modifier
                        @else Enregistrer
                        @endif
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
    
@endsection
    
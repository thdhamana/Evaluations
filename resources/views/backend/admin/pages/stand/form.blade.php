@extends('backend.admin.home')

@section('title', $stand->exists ? "Edition d'un standard": "Enregistrement d'un standard")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.stand.index')}}">Liste standards</a></li>
        <li class="breadcrumb-item active">
            @if ($stand->exists)
                Modification                
            @else
                Enregistrement
            @endif
        </li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card mt-2">
    <div class="card-body col-lg-10 m-auto">
        <form class="vstack mt-4  gap-2" action="{{ route($stand->exists ? 'admin.stand.update': 'admin.stand.store', $stand) }}" method="post" enctype="multipart/form-data">

            @method($stand->exists ? 'put' : 'post')
            @csrf

            <div class="row gap-2 ">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="floatingnom" placeholder="nom" value="{{old('nom', $stand->nom)}}">
                        <label for="floatingnom">Nom du standard</label>
                        <div class="invalid-feedback">@error('nom') {{ $message }} @enderror</div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 my-2">            
                    <div class="form-group">           
                        <select name="domaine_id" id="floatingdomaine_id" class="py-3 form-select @error('domaine_id') is-invalid @enderror">
                            <option value="">Sélectionner un domaine</option>
                            @foreach($domaines as $key => $domaine)
                                <option @selected(old('domaine_id', $stand->domaine_id == $domaine->id)) value="{{$domaine->id}}" class="py-2">{{ $domaine->nom}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('domaine_id') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 my-2">
                    <div class="form-floating">
                        <input class="form-control @error('fichier') is-invalid @enderror" type="file" name="fichier" id="floatingfichier" placeholder="fichier" value="{{old('fichier', $stand->fichier)}}">
                        <label for="floatingfichier">Description en PDF</label>
                        <div class="invalid-feedback">@error('fichier') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($stand->id) Modifier
                        @else Enregistrer
                        @endif
                    </button>
                </div>
            </div>
        </form> 
    </div>
</div>
    
@endsection
    
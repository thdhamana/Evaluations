@extends('backend.personnal.home')

@section('title', $evaluer->exists ? "Edition d'un standard" : "Upload du fichier pour")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('personnal.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active"><a href="{{route('personnal.evaluer.index')}}">Liste des domaines</a></li>
            <li class="breadcrumb-item active"> Modification du fichier </li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card mt-2">
    <div class="modal-header bg-primary text-white p-2 px-3 d-flex justify-content-center ">
        <b class="fw-bold fs-4 "><i class="fa fa-pen-square"></i> Modification du document </b>
    </div>
    <div class="card mt-2">
        <div class="card-body col-lg-11 m-auto">
            <form class="vstack mt-4 gap-2" action="{{ route('personnal.evaluer.update', $evaluer) }}" method="post" enctype="multipart/form-data">
    
                @method('put')
                @csrf
    
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="form-floating">
                            <input class="form-control @error('stand_id') is-invalid @enderror" type="text" name="stand_id" id="floatingstand_id" placeholder="stand_id" value="{{old('stand_id', $nomstandard)}}" disabled>
                            <label for="floatingstand_id">Nom du standard</label>
                            <div class="invalid-feedback">@error('stand_id') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="form-floating">
                            <input class="form-control @error('docs') is-invalid @enderror" type="file" name="docs" id="floatingdocs" placeholder="docs" value="{{old('docs', $evaluer->docs)}}">
                            <label for="floatingdocs">Document PDF à uploader</label>
                            <div class="invalid-feedback">@error('docs') {{ $message }} @enderror</div>
                        </div>
                        @if ($evaluer->docs)
                            <p>Document actuel : <a href="{{ Storage::url('evaluers/' . $evaluer->docs) }}" target="_blank">{{ $evaluer->docs }}</a></p>
                        @endif
                    </div>
                </div>
                <div class="row">    
                    <div class="d-flex flex-row justify-content-end align-items-end my-2 gap-2">
                        <a class="btn btn-outline-primary" href="{{route('personnal.evaluer.index')}}">
                            Annuler la modification du fichier
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Modifier le fichier
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

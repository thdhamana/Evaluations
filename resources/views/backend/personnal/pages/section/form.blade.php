@extends('backend.admin.home')

@section('title', $section->exists ? "Edition d'une section": "Enregistrement d'une section")

@section('content')
<div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
        <li class="breadcrumb-item active"><a href="{{route('admin.section.index')}}">Liste sections</a></li>
        <li class="breadcrumb-item active">
            @if ($section->exists)
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
        <form class="vstack mt-4  gap-2" action="{{ route($section->exists ? 'admin.section.update': 'admin.section.store', $section) }}" method="post" enctype="multipart/form-data">

            @method($section->exists ? 'put' : 'post')
            @csrf

            <div class="row gap-2 ">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="floatingnom" placeholder="nom" value="{{old('nom', $section->nom)}}">
                        <label for="floatingnom">Section / Filière</label>
                        <div class="invalid-feedback">@error('nom') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="form-floating">
                        <input class="form-control @error('abreger') is-invalid @enderror" type="text" name="abreger" id="floatingabreger" placeholder="abreger" value="{{old('abreger', $section->abreger)}}">
                        <label for="floatingabreger">Abrégé</label>
                        <div class="invalid-feedback">@error('abreger') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 my-2">            
                    <div class="form-group">           
                        <select name="service_id" id="floatingdepartment_id" class="py-3 form-select @error('service_id') is-invalid @enderror">
                            <option value="">Sélectionner un service</option>
                            @foreach($services as $key => $service)
                                <option @selected(old('service_id', $section->service_id == $service->id)) value="{{$service->id}}" class="py-2">{{ $service->nom}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('service_id') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if ($section->id) Modifier
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
    
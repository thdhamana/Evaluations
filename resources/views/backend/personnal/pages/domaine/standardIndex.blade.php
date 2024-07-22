@extends('backend.personnal.home')

@section('title', 'Se faire standard')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('personnal.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Se faire standard</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{session('success')}}
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <h4 class="fs-3 fw-bold text-center py-3 bg-body-secondary">Liste des standards dudit domaine</h4>
            
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover table-centered mb-0" id="dataTable">
                        <thead>
                            <th>N°</th>
                            <th>Standard</th>
                            <th>Documents qui fait une description des differents standard </th>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($standards as $k => $standard)
                            <tr>
                                <td class="p-1 text-center">{{$k+1}} </td> 
                                <td class="p-1">{{$standard->nom}} </td>
                                <td title="Voir le contenu de la description du standard correspondant">
                                    <a class="" href="{{ Storage::url('public/standards/' . $standard->fichier) }}" target="_blank">
                                        <i class="fa fa-eye btn-color-primary me-2"></i>
                                        {{$standard->fichier}}
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                   <td colspan="5">
                                        <div class="alert alert-primary text-center fw-bold">Aucune donnée ne correspond à cette recherche !</div>
                                   </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>
    <!-- /.container-fluid -->
@endsection



@extends('backend.personnal.home')

@section('title', 'Référentiels')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('personnal.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Référentiels</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Begin Page Content -->
    <div class="container-fluid ">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{session('success')}}
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row justify-content-between m-1">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div id="dataTable_filter" class="dataTables_filter">
                        <input type="search" id="searchInput" class="form-control" placeholder="Research..." aria-controls="dataTable">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 text-end">
                    <button id="refreshButton" type="button" class="btn btn-outline-primary me-2"><i class='fa fa-refresh'></i> Refresh</button>
                    {{-- <a class="btn btn-primary" href="{{ route('personnal.referentiel.create')}}"><i class='fa fa-add fw-bold me-1'></i>Add a new referentiel</a> --}}
                </div>

            </div>
            
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover table-centered mb-0" id="dataTable">
                        <thead>
                            <tr class="tr">
                               <th class="n_">
                                   <span class="d-flex justify-content-between mb-0">N°
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>
                                
                                <th class="d-flex flex-row justify-content-between">
                                    <span>Nom du référentiel</span>
                                    <span class="d-flex flex-row float-right mt-1 fleche">
                                        <i class="fa fa-arrow-up-long "></i>
                                        <i class="fa fa-arrow-down-long "></i>
                                    </span>
                                </th>
                                <th>Visionner le document</th>  
                                <th>Télécharger le document</th>  
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($referentiels as $k => $referentiel)
                                <tr>
                                    <td class="p-1 text-center">{{$k+1}} </td>
                                    <td class="p-1">{{$referentiel->nom}} </td>
                                    <td title="Voir le contenu de la reference" class="px-5">
                                        <a class="fs-4 me-2" href="{{ Storage::url('public/referentiels/' . $referentiel->pdf) }}" target="_blank">
                                            <i class="fa fa-eye btn-color-primary ms-2"></i>
                                            Visionner le contnu
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('referentiel.download', $referentiel) }}" class="text-center fs-4 d-flex justify-content-center "><i class="fa-solid fa-download"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                   <td colspan="3">
                                        <div class="alert alert-primary text-center fw-bold">Aucune donnée ne correspond à cette recherche !</div>
                                   </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="pagination-rounded">
                    {{$referentiels->links()}}
                </ul>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection


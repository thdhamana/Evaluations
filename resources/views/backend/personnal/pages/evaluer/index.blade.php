@extends('backend.personnal.home')

@section('title', 'Se faire domaine')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('personnal.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Se faire domaine</li>
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
            <h4 class="fs-3 fw-bold text-center py-3 bg-body-secondary">Liste des domaines d'evaluation</h4>
            <div class="card-header d-flex flex-row justify-content-between m-1">
                <div class="col-sm-12 col-md-10">
                    <div class="row">
                        <div class="col-5">
                            <label for="searchInput" class="fs-5 fw-bold">Rechercher par plusieurs critères</label>
                        </div>
                        <div class="col-7">
                            <input type="search" id="searchInput" class="form-control" placeholder="Saisissez ici ce que vous voulez rechercher..." aria-controls="dataTable">
    
                        </div>
                    </div>
                    <div id="dataTable_filter" class="dataTables_filter d-flex flex-row">
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 text-end">
                    <button id="refreshButton" type="button" class="btn btn-outline-primary me-2"><i class='fa fa-refresh'></i> Refresh</button>
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
                                    <span>Les domaines d'evaluation</span>
                                    <span class="d-flex flex-row float-right mt-1 fleche">
                                        <i class="fa fa-arrow-up-long "></i>
                                        <i class="fa fa-arrow-down-long "></i>
                                    </span>
                                </th>
                                <th>Domaine d'evaluation</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($domaines as $k => $domaine)
                            <tr>
                            <td class="p-1 text-center">{{$k+1}} </td> 
                                <td class="p-1">{{$domaine->nom}} </td>
                                <td class="p-1">
                                    <a title="Veuillez cliquer dessus pour choisir le domaine dans le quel vous souhaiterez être evaluer" href="{{route('personnal.getStandards', $domaine)}}">
                                        Cliquer ici pour passer à l'evaluation
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

        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <ul class="pagination-rounded">
                        {{$domaines->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection



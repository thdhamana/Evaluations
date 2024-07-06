@extends('backend.admin.home')

@section('title', 'Standards')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Standards</li>
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
                    <a class="btn btn-primary" href="{{ route('admin.stand.create')}}"><i class='fa fa-add fw-bold me-1'></i>Add a new standard</a>
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
                                    <span>Nom</span>
                                    <span class="d-flex flex-row float-right mt-1 fleche">
                                        <i class="fa fa-arrow-up-long "></i>
                                        <i class="fa fa-arrow-down-long "></i>
                                    </span>
                                </th>
                                <th >
                                    <span class="d-flex justify-content-between mb-0">Domaine
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>  
                                <th class="">Description</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($stands as $k => $stand)
                                <tr>
                                    <td class="p-1 text-center">{{$k+1}} </td>
                                    <td class="p-1">{{$stand->nom}} </td>
                                    <td class="p-1">{{$stand->domaine->nom}} </td>
                                    <td title="Voir le contenu de la description" class="px-5">
                                        <a class="fs-4 me-2" href="{{ Storage::url('public/standards/' . $stand->fichier) }}" target="_blank"><i class="fa fa-eye btn-color-primary"></i></a>
                                    </td>

                                    <td class="p-1 d-flex gap-1 justify-content-end ">
                                        <a href="{{ route('admin.stand.edit', $stand) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        
                                        <!-- Bouton pour déclencher le modal de confirmation -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$k}}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Modale de confirmation -->
                                        <div class="modal fade" id="verticalycentered{{$k}}" tabindex="-1" aria-labelledby="confirmationModalLabel{{$k}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header bg-primary text-white p-2 px-4">
                                                    <h6 class="modal-title" id="confirmationModalLabel{{$k}}">Confirmez-vous cette suppression !</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>       
                                                </div>
                                                <div class="modal-body d-flex flex-column gap-2">
                                                    <i class="fa fa-warning text-danger fs-1"></i>
                                                    <b>Etes-vous sûr de vouloir supprimer cette stand/filière ???</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                   <!-- Formulaire de suppression -->
                                                    <form action="{{ route('admin.stand.destroy', $stand)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Oui</button>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div><!-- End Vertically centered Modal-->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                   <td colspan="5">
                                        <div class="alert alert-info text-center fw-bold">Aucune donnée ne correspond à cette recherche !</div>
                                   </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">

            <div class="card">
                
                  <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Vertically Centered</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Vertically centered Modal-->
            
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="pagination-rounded">
                        {{$stands->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection



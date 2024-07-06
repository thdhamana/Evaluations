@extends('backend.admin.home')

@section('title', 'Services / Départements')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Services</li>
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
                    <a class="btn btn-primary" href="{{ route('admin.service.create')}}"><i class='fa fa-add fw-bold me-1'></i>Add a new service</a>
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
                                    <span class="d-flex justify-content-between mb-0">Abrégé
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>                                
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($services as $k => $service)
                                <tr>
                                    <td class="p-1 text-center">{{$k+1}} </td>
                                    <td class="p-1">{{$service->nom}} </td>
                                    <td class="p-1">{{$service->abreger}} </td>
                                    <td class="p-1 d-flex gap-1 justify-content-end ">
                                        <a href="{{ route('admin.service.edit', $service) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        
                                        <!-- Bouton pour déclencher le modal de confirmation -->
                                        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#confirmationModal{{$k}}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Modale de confirmation -->
                                        <div class="modal fade" id="confirmationModal{{$k}}" tabindex="-1" aria-labelledby="confirmationModalLabel{{$k}}" aria-hidden="true">
                                            <div class="modal-dialog rounded">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white p-2">
                                                        <h5 class="modal-title" id="confirmationModalLabel{{$k}}">Confirmation of the deletion of the service</h5>
                                                        <button type="button" class="close text-white me-1" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>         
                                                    </div>
                                                    <div class="modal-body d-flex flex-column gap-2 align-items-center">
                                                    <div>
                                                        <?php for ($i=0; $i < 5; $i++) { ?>
                                                            <img width="30px" height="30px" src="{{asset('backend/img/R.gif')}}" alt="" srcset="">
                                                        <?php }?>
                                                    </div>
                                                    <p>Are you sure you want to delete this service ??</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                                        <!-- Formulaire de suppression -->
                                                        <form action="{{ route('admin.service.destroy', $service)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Yeah</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                   <td colspan="4">
                                        <div class="alert alert-info text-center fw-bold">Aucune donnée ne correspond à cette recherche !</div>
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
                    {{$services->links()}}
                </ul>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@extends('backend.admin.home')

@section('title', 'Evaluateurs')

@section('content')
    <div class="pagetitle d-flex flex-row justify-content-between">
        <div>
            <h1>@yield('title')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
                    <li class="breadcrumb-item active">Evaluateurs</li>
                </ol>
            </nav>
        </div>
        <div class="fs-2">
            Total : 
            <span class="fw-bold text-primary">
                {{$countEvaluateurs}}
            </span>
        </div>
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
                    <a class="btn btn-primary" href="{{ route('admin.evaluateur.create')}}"><i class='fa fa-add fw-bold me-1'></i>Add a new evaluator</a>
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
                                
                                <th class="d-flex flex-row justify-content-between mb-0">
                                    <span>Prénom</span>
                                    <span class="d-flex flex-row float-right mt-1 fleche">
                                        <i class="fa fa-arrow-up-long "></i>
                                        <i class="fa fa-arrow-down-long "></i>
                                    </span>
                                </th>
                                <th >
                                    <span class="d-flex justify-content-between mb-0">Nom
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>
                                <th >
                                    <span class="d-flex justify-content-between mb-0">Téléphone
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th> 
                                <th >
                                    <span class="d-flex justify-content-between mb-0">Email
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>
                                <th>
                                    <span class="d-flex justify-content-between mb-0">D E
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>  
                                <th>
                                    <span class="d-flex justify-content-between mb-0">Evaluateur
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>                           
                                {{-- <th >
                                    <span class="d-flex justify-content-between mb-0">Photo
                                        <span class="d-flex flex-row float-right mt-1 fleche">
                                            <i class="fa fa-arrow-up-long "></i>
                                            <i class="fa fa-arrow-down-long "></i>
                                        </span>
                                   </span>
                                </th>    --}}
                                                             
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- pour la numerotation --}}
                            @php
                                $numero = 1;
                            @endphp
                            {{-- fin --}}
                            @forelse ($evaluateurs as $k => $evaluateur)
                                @if ($evaluateur->evaluateur === 0)
                                <tr>
                                    <td class="p-1 text-center">{{$numero++}} </td>
                                    <td class="p-1">{{$evaluateur->name}} </td>
                                    <td class="p-1">{{$evaluateur->nom}} </td>
                                    <td class="p-1">{{$evaluateur->telephone}} </td>
                                    <td class="p-1">{{$evaluateur->email}} </td>
                                    <td class="p-1">
                                        <form class="evaluateur-form" action="{{ route('admin.droit_eva') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="evaluateur_id" value="{{ $evaluateur->id }}">
                                            <div class="form-check form-switch fs-5 align-items-center">
                                                <input class="form-check-input switch-evaluateur" type="checkbox" name="droit_eval" {{ $evaluateur->droit_eval ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <!-- Bouton pour déclencher le modal de confirmation -->
                                        <button type="button" class="btn btn-light px-1 py-0" data-bs-toggle="modal" data-bs-target="#evaluateurs{{$k}}">
                                            <div class="form-check form-switch fs-5 align-items-center">
                                                <input class="form-check-input switch-evaluateur" type="checkbox" name="evaluateur" disabled >
                                            </div>
                                        </button>
                                        <!-- Modale de confirmation -->
                                        <div class="modal fade" id="evaluateurs{{$k}}" tabindex="-1" aria-labelledby="confirmationModalLabel{{$k}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header bg-primary text-white p-2 px-4">
                                                    <h6 class="modal-title" id="confirmationModalLabel{{$k}}">Confirmez-vous le retrait de cet évaluateur !!</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>       
                                                </div>
                                                <div class="modal-body d-flex flex-column gap-2">
                                                    <i class="fa fa-warning text-danger fs-1"></i>
                                                    <b>Etes-vous sûr de vouloir retirer cet(cette) évaluateur(rice) de la liste ??</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                        <div class="form-check form-switch fs-5 align-items-center">
                                                            <input class="form-check-input switch-evaluateur" type="checkbox" name="evaluateur" disabled >
                                                        </div>
                                                    </button>
                                                   <!-- Formulaire de suppression -->
                                                   <form class="evaluateur-form btn btn-danger" action="{{ route('admin.evaluateur') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="evaluateur_id" value="{{ $evaluateur->id }}">
                                                        <div class="form-check form-switch fs-5 align-items-center">
                                                            <input class="form-check-input switch-evaluateur" type="checkbox" name="evaluateur" {{ $evaluateur->evaluateur ? 'checked' : '' }}>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div><!-- End Vertically centered Modal-->
                                    </td>
                                    {{-- <td><img width="50px" src="{{asset('storage/evaluateurs/'.$evaluateur->photo) }}" alt=""></td> --}}
                                    <td class="p-1 d-flex gap-1 justify-content-end ">
                                        <a href="{{ route('admin.evaluateur.edit', $evaluateur) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        
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
                                                    <b>Etes-vous sûr de vouloir supprimer ce evaluateur ???</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                   <!-- Formulaire de suppression -->
                                                    <form action="{{ route('admin.evaluateur.destroy', $evaluateur)}}" method="post">
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
                                @endif
                            @empty
                                <tr>
                                   <td colspan="8">
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
                    {{$evaluateurs->links()}}
                </ul>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var switches = document.querySelectorAll('.switch-evaluateur');
            switches.forEach(function (element) {
                element.addEventListener('change', function (event) {
                    event.target.closest('form').submit();
                });
            });
        });
    </script>
    
    
        {{-- <script>
            $(document).ready(function() {
                $('.switch-evaluateur').change(function() {
                    var evaluateurForm = $(this).closest('.evaluateur-form'); // Trouver le formulaire le plus proche
                    var evaluateurId = evaluateurForm.find('input[name="evaluateur_id"]').val(); // Récupérer l'identifiant de l'évaluateur à partir du formulaire
                    var isChecked = $(this).prop('checked');
                    var url = "{{ route('admin.evaluateur.droit_eva') }}"; // URL de la route pour la mise à jour
        
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            evaluateur_id: evaluateurId,
                            droit_eval: isChecked,
                        },
                        success: function(response) {
                            // Gérer la réponse du serveur (facultatif)
                            console.log(response); // Afficher la réponse dans la console pour le débogage
                        },
                        error: function(error) {
                            console.error(error); // Afficher l'erreur dans la console en cas de problème
                        }
                    });
                });
            });
        </script> --}}
        
@endsection


@extends('backend.personnal.home')

@section('title', 'Se faire evaluer')

@section('content')
    <div class="pagetitle">
        <h1>@yield('title')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('personnal.home')}}">Accueil</a></li>
            <li class="breadcrumb-item active">Se faire evaluer</li>
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
            <h4 class="fs-3 fw-bold text-center py-3 bg-body-secondary">Liste des standards sur les quels vous devez être</h4>
            
            <div class="d-flex flex-row gap-0">
                <div class="card-body pe-0">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-hover table-centered mb-0" id="dataTable">
                            <thead>
                                <th>N°</th>
                                <th>Standards</th>
                                <th>Ajouter</th>
                            </thead>
                            <tbody id="tableBody">
                                @forelse ($evaluers as $k => $evaluer)
                                <tr>
                                    <td class="p-1 text-center">{{$k+1}} </td> 
                                    <td class="p-1">{{$evaluer->nom}} </td>
                                    
                                    <td class="p-1 d-flex gap-1 justify-content-center ">
                                        <!--Bouton pour déclencher le modal pour l'ajout -->
                                        <a title="Ajouter un nouveau decument pour ce standard" href="{{ route('personnal.evaluer.edit', $evaluer)}}" >
                                            <i class='bi bi-plus-circle fw-bold fs-5 ms-1'></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                       <td colspan="3">
                                            <div class="alert alert-info text-center fw-bold">Aucun document document pour ce standard !</div>
                                       </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body ps-0">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-hover table-centered mb-0" id="dataTable">
                            <thead>
                                <th>No</th>
                                <th>Document PDF</th>
                                <th>Autre Action</th>
                            </thead>
                            <tbody id="tableBody">
                                @forelse ($evaluersDocs as $k => $evaluersDoc)
                                <tr>
                                    <td class="p-1 text-center">{{$k+1}} </td> 
                                    <td title="Voir le contenu du document">
                                        <a class="me-2" href="{{ Storage::url('public/evaluers/'. $evaluersDoc->docs) }}" target="_blank">
                                            <i class="fa fa-eye btn-color-primary"></i>
                                            <span>Plus de detail</span>
                                        </a>
                                    </td>
                                    <td>
                                        <!--Bouton pour déclencher le modal pour la modification -->
                                        <a title="Modifier le document existant"  href="{{ route('personnal.evaluer.edits', $evaluer->id) }}" >
                                            <i class="bi bi-pencil-square fs-5 ms-1"></i>
                                        </a>
                                        <!-- Bouton pour déclencher le modal de confirmation de la soumission -->
                                        <a title="Soumetre le document à l'évaluateur" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$k}}">
                                            <i class="bi bi-send fs-5 ms-1 text-primary"></i>
                                        </a>
    
                                        <!-- Modale de confirmation pour la soumission -->
                                        <div class="modal fade" id="verticalycentered{{$k}}" tabindex="-1" aria-labelledby="confirmationModalLabel{{$k}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header bg-primary text-white p-2 px-4">
                                                    <h6 class="modal-title fw-bold" id="confirmationModalLabel{{$k}}">Certifiez-vous que ce document est terminé ?</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>       
                                                </div>
                                                <div class="modal-body d-flex flex-column gap-2">
                                                    <i class="fa fa-warning text-danger fs-1"></i>
                                                    <b class="modalText">
                                                        Etes-vous sûr de vouloir envoyer ce document à l'evaluateur ? <br>
                                                        Rassurez-vous avant de le faire, car cette action est irreversible
                                                    </b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                    <!-- Formulaire de suppression -->
                                                    <form action="{{ route('personnal.evaluer.destroy', $evaluer)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Oui</button>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div><!-- End Vertically centered Modal-->
                                        <span>En attente</span>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                       <td colspan="2">
                                            <div class="alert alert-light text-center fw-bold py-1">Aucun document document pour ce standard !</div>
                                       </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <!-- /.container-fluid -->
@endsection



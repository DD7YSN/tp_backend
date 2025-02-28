@extends('layouts.master')

@section('title', 'Livreur | Livraison')

@section('content')
<style>
  #formChangerStatus {
        width: 55%;
        padding: 32px 48px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        position: absolute;
        top: -130%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #FFF;
        transition: 1s;
        visibility: hidden;
        z-index: 9;
    }

    .showForm {
        top: 50px !important;
        visibility: visible !important;
    }
    .line {
    width: 100%; /* Full width of the parent */
    border: 1px solid black; /* Adjust thickness */
    margin: 0; /* Remove extra spacing if needed */
}
</style>
  <div class="home">
    @include('layouts.sideBarLivreur')

    <div class="main pb-5">
    @include('layouts.nav')
    
    <div class="card right-side mx-lg-3 mt-3">
      <div class="card-body p-3">
        <h4 class="card-title mb-0">Colis </h4>
      </div>
    </div>

    <div class="mx-lg-3">
        <div class="acc-filter">
        <div class="colis-filter">
          <div class="accordion mt-3" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              Filtrer
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <form id="formFilter" method="POST" class="mt-4">
                @csrf
              <div class="form-group">
                <div class="row">
                <div class="col-md-4">
                  <div class="">
                  <input type="text" name="track_number" class="form-control" placeholder="Rechercher coli">
                  </div>
                </div>
  
                <div class="col-md-4">
                  <div class="mb-3">
                  <select name="etat" class="select2 form-control">
                    <option value="-1">Etat</option>
                    <option value="0">Non paye</option>
                    <option value="1">Paye</option>
                  </select>
                  </div>
                </div>
  
  
  
                <div class="col-md-4">
                  <div class="mb-3">
                  <select name="id_status" class="select2 form-control">
                    <option value="-1">Status</option>
                    <option value="0">Attender Ramassage</option>
                    <option value="1">Liver</option>
                  </select>
                  </div>
                </div>
                </div>
  
  
  
                <div class="row">
                <div class="col-md-4">
                  <select name="id_ville" class="select2 form-control">
                  <option value="-1">Villes</option>
                  <option value="1">Option1</option>
                  <option value="2">Option1</option>
                  </select>
                </div>
  
                <div class="col-md-4">
                  <select id="id_business" class="select2 form-control">
                  <option value="-1">Business</option>
                  <option value="1">Option1</option>
                  <option value="2">Option1</option>
                  </select>
                </div>
  
                <div class="col-md-4">
                  <input type="date" name="date" class="form-control" value="">
                </div>
                </div>
              </div>
              <div class="form-actions mt-3">
                <div class="d-flex justify-content-end gap-6">
                <button type="submit" class="btn btn-primary ">
                  Filter
                </button>
                <button type="reset" class="btn bg-danger-subtle text-danger ">
                  Reset
                </button>
                </div>
              </div>
            </div>
  
            </div>
  
  
            </form>
          </div>
          </div>
        </div>
        </div>
      </div>
          <div class="card right-side mx-lg-3 mt-4">
            <div class="table-responsive border rounded">
            <table id="row_group" class="table w-100 table-striped table-bordered display text-nowrap dataTable"
              aria-describedby="row_group_info">
              <thead>
              <tr>
                <th>code Suivi</th>
                <th>Date d'expidition</th>
                <th>Télephone</th>
                <th>Nom du magasin</th>
                <th>Etat</th>
                <th>Status</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody id="colisTableBody">
                @if ($colis->isEmpty())
              <tr>
                <td class="text-center" colspan="10">
                Aucune Colis pour afficher
                </td>
              </tr>
              @else
              @foreach ($colis as $coli)
              <tr id="{{$coli->track_number}}">
                <td>{{$coli->track_number}}</td>
                <td>{{$coli->created_at}}</td>
                <td>{{$coli->telephone}}</td>
                <td>{{$coli->client->nom_magasin ?? $coli->utilisateur->nom}}</td>
                <td><span style="padding: 6px 15px;" class="badge bg-info-subtle text-info">
                    {{$coli->etat ? 'Paye' : 'Non Paye' }}
                    </span></td>
                <td>@if ($coli->id_status)
                    <span style="padding: 6px 15px;"
                    class="badge bg-{{ $coli->status->color }}-subtle text-{{ $coli->status->color }}">
                    {{ $coli->status->nom_status }}
                    </span>
                  @endif</td>
                <td>{{$coli->ville->nom_ville}}</td>
                <td>{{$coli->prix}}</td>
                <td class="text-center">
                    <div class="dropdown dropstart">
                    <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
              
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)">
                    <i class='bx bx-list-ul fs-7'></i>
                    Suivi
                    </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" target="_blank"
                        data-bs-toggle="modal" data-bs-target="#al-success-alert" href="#">
                        <i class='bx bx-info-circle fs-7' style='color:#08a61f'  ></i>
                        Informations du colis
                        </a>
                        </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2"
                        href="javascript:void(0)" id="changerStatus">
                        <i class='bx bxs-pencil fs-7'></i>
                        Changer le status
                        </a>
                        </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" target="_blank"
                    href="">
                    <i class='fs-7 bx bxs-printer'></i>
                    Ticket
                    </a>
                    </li>
                    </ul>
                    </div>
                    </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            </div>
          </div>

          <div id="formChangerStatus">
            <h4 class="card-title mb-3">Changer Status du colis</h4>
            <hr class="line">
            <div class="row" id="colisInfo">
              
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <select id="colisStatus" class="form-select" name="colisStatus">
                      <option value="-1">Choisissez le status ...</option>
                      @foreach($statuses as $status)
                          <option value={{$status->id}}>{{$status->nom_status}}</option>
                        @endforeach
                      
                    </select>
                  </div>
                  <div id="statusAcompanient">
                    <div class="mb-3 col-12">
                      <div class="col-md-12">
                        <div class="col-md-12">
                            <div class=" mb-3 ">
                                <label for="inputCommentaire" class="form-label">Commentaire </label>
                                <textarea class="form-control" name="commentaire" id="inputCommentaire" cols="20"
                                    rows="3"
                                    placeholder="Commentaire "></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                            <button id="annuler" type="reset" class="btn bg-danger-subtle text-danger hstack gap-6">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary hstack gap-6" id="chagerButton">
                                changer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          </div>          
        
</div>
</div>
<script>
    const annuler = document.getElementById('annuler');
    const formChangerStatus = document.getElementById('formChangerStatus');
    const colis = @json($colis);
    const colisInfo = document.getElementById('colisInfo');
    let idColisSelected;
    document.querySelectorAll('#changerStatus').forEach(changerStatusOption => {
    changerStatusOption.addEventListener('click', () => {
        const formChangerStatus = document.getElementById('formChangerStatus');
        const colisInfo = document.getElementById('colisInfo');
        formChangerStatus.classList.add('showForm');
        idColisSelected = changerStatusOption.closest('tr').id;
        const colisSelected = colis.find(colis => colis.track_number == idColisSelected);
        colisInfo.innerHTML = `
        <div class=" d-flex justify-content-center ">
        <div class="row  p-4 ">
        <div class="col-md-6">
            <p><strong class="text-dark">Code Suivi:</strong> ${colisSelected.track_number}</p>
            <p><strong class="text-dark">Telephone:</strong> ${colisSelected.telephone}</p>
            <p><strong class="text-dark">Etat:</strong> ${colisSelected.etat ? 'Paye' : 'Non Paye'}</p>
            <p><strong class="text-dark">Ville:</strong> ${colisSelected.ville.nom_ville}</p>
            <p><strong class="text-dark">Prix:</strong> ${colisSelected.prix}</p>
        </div>
        <div class="col-md-6">
            <p><strong class="text-dark">Date d'expidition:</strong> ${colisSelected.bon_envoi ? colisSelected.bon_envoi.created_at : 'N/A'}</p>
            <p><strong class="text-dark">Status:</strong> <span class="badge bg-${colisSelected.status.color }-subtle text-${colisSelected.status.color }">${colisSelected.id_status ? colisSelected.status.nom_status : 'N/A'}</span></p>
        </div>
        </div>
    </div>
        `;
        
    });
  });
    annuler.addEventListener('click', () => {
      formChangerStatus.classList.remove('showForm')
    })
    
    document.getElementById('colisStatus').addEventListener('change',()=>{
      const statuses = @json($statuses);
      const statusAcompanient = document.getElementById('statusAcompanient');
      const statusSelected = statuses.find(statu => statu.id == status);
      const status = document.getElementById('colisStatus').value;

  });
  const chagerButton = document.getElementById('chagerButton');
  chagerButton.addEventListener('click', () => {
    const status = document.getElementById('colisStatus').value;
    const commentaire = document.getElementById('inputCommentaire').value;
    const errorMessages = document.querySelectorAll(".form-control-feedback");
    errorMessages.forEach(msg => msg.remove()); 
    if(status == '-1'){
      showError('colisStatus', 'Veuillez selectionner le status');
    }
    if(commentaire == ''){
      showError('inputCommentaire', 'Veuillez entrer le commentaire');
    }

  });
  function showError(inputId, message) {
        const inputField = document.getElementById(inputId);
        const errorSmall = document.createElement("small");
        errorSmall.classList.add("form-control-feedback", "text-danger");
        errorSmall.textContent = message;
        inputField.parentElement.appendChild(errorSmall);
    }

  

</script>
@endsection
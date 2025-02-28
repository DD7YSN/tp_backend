@extends('layouts.master2')
@section('content')
    <div class="home">
      @include('layouts.sideBarModerateur')
    
    <div class="main">
      @include('layouts.nav')

      <div class="mx-3"> 
        
      <div class="table-cont mx-auto">
        <div class="table-responsive">



          <div class="table-responsive mb-2 border rounded-1 mt-4">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Ref</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Date D'expedition</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Télephone</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Nom du magasin</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Etat</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Statut</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Ville</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Prix</h6>
                  </th>
                  <th>Action</th>
                  <th scope="col">
                    <label for="tout">
                      Tout
                    </label>
                    <input class="form-check-input primary" type="checkbox" id="tout">
                  </th>
                </tr>
              </thead>
              <tbody id="colisTable">
                
              </tbody>
            </table>


          </div>
          </div>
        </div>
        <div class="d-flex flex-column align-items-end">
          <span id="ajouter-btn" class="ms-auto btn btn-success mb-2 ">Ajouter</span>
        </div>


        <div class="d-flex justify-content-between" style="display: none;">

          <div class="card col-5" id="listLivreurs" style="display: none;">
            <div class="card-body ">
              <h4 class="card-title mb-3">Liste des livreur</h4>
            <ol class="list-group list-group-numbered" id="listeLivreurOl">
              
            </ol>
          </div>
          </div>

        <div>
          <div class="table-responsive mb-2 border rounded-1" >
            <table class="table text-nowrap mb-0 align-middle" style="display: none">
              <thead class="text-dark fs-4">
                <tr>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Reference</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Nom du magasin</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Ville</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                  </th>
                </tr>
              </thead>
              <tbody id="colisLivreurTable">
                
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-column align-items-end" style="display: none">
            <span id="valider-btn" class="ms-auto btn btn-success mb-2 ">Valider</span>
          </div>
          
        </div>
      </div>



        <div id="primary-header-modal" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                  <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    Bon Distribution
                  </h4>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h5 >Colis selectionnez :<span id="colis-count">0</span></h5>
                  <h5 class="mt-0">Livreur</h5>
                  <div class="row">
                    <div class="mb-3">
                      <select id="livreur" class="form-select" name="id_livreur">
                        <option value="-1">Choisissez livreur ...</option>
                        @foreach($livreur as $liv)
                            <option value={{$liv->id}}>{{$liv->nom}}</option>
                          @endforeach
                        
                      </select>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" id="annuler" class="btn btn-light" data-bs-dismiss="modal">
                    Annuler
                  </button>
                  <button type="submit" id="btn-enregisterBonDistr" class="btn bg-primary-subtle text-primary ">
                    Enregister
                  </button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
      </div>
    </div>
  </div>
  <script>
  const tout = document.getElementById('tout');
  const ajouterBtn = document.getElementById('ajouter-btn'); 
  const enregisterBonDistr = document.getElementById('btn-enregisterBonDistr');

  function getSelectedColis() {
    const checkboxes = document.querySelectorAll('tbody tr td .coli-checked');
    const colis = [];
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        colis.push(checkbox.parentElement.parentElement.id);  
      }
    });
    return colis;
  }
  tout.addEventListener('click', () => {
    const checkboxes = document.querySelectorAll('tbody tr td .coli-checked');
    checkboxes.forEach(checkbox => {
      checkbox.checked = tout.checked; 
    });

  });

 
  ajouterBtn.addEventListener('click', () => {
    const colis = getSelectedColis();
    const errorMessages = document.querySelectorAll(".form-control-feedback");
        errorMessages.forEach(msg => msg.remove());  
    if(colis.length === 0){
      showError('ajouter-btn', 'Veuillez selectionner au moins un colis');
    }else{

      document.getElementById('colis-count').innerHTML = colis.length;  
      $('#primary-header-modal').modal('show');
    }

    
  });
  enregisterBonDistr.addEventListener('click', () => {
    const colis = getSelectedColis();
    const livreur = document.getElementById('livreur').value;
    const errorMessages = document.querySelectorAll(".form-control-feedback");
    errorMessages.forEach(msg => msg.remove()); 
    if(livreur == '-1'){
      showError('livreur', 'Veuillez selectionner le livreur');
    }else{
      $('#primary-header-modal').modal('hide');
      let bon = {
        livreur_id: livreur,
        colis_ids: colis
      };

      let bonDistributions = JSON.parse(localStorage.getItem('bon_distribution')) || [];
      bonDistributions.push(bon);
      localStorage.setItem('bon_distribution', JSON.stringify(bonDistributions));


      const checkedColis = getSelectedColis();  
        fillListeLivreur();
        checkedColis.forEach(coliId => {
           const row = document.getElementById(coliId);
           if (row) {
              row.remove();
           }

          });
          const colisList = @json($colis);
          const storedColisRefs = unvalidatedColis()
          const filteredColis = colisList.filter(colis => !storedColisRefs == colis.ref);
          console.log(filteredColis)

      }
      fillColisTable();
      });


    function fillListeLivreur() {
      const liste = document.getElementById('listLivreurs');
      const livreurOl = document.getElementById('listeLivreurOl');
      const bonDistributions = JSON.parse(localStorage.getItem('bon_distribution')) || [];
      
      livreurOl.innerHTML = '';
      const livreurs = @json($livreur);
      bonDistributions.forEach(bon => {
        const matchedLivreur = livreurs.find(livreur => livreur.id == bon.livreur_id);
        const livreurName = matchedLivreur ? matchedLivreur.nom : "Inconnu";
        livreurOl.innerHTML += (`
              <li class="list-group-item d-flex justify-content-between align-items-start m-0" id="${bon.colis_ids[0]}">
                  <div class="ms-2 me-auto">
                      <div class="fw-bold">${livreurName}</div>
                  </div>
                  <span class="badge bg-primary">${bon.colis_ids.length}</span>
              </li>
          `);
      });
      
      const listItems = livreurOl.querySelectorAll('li');
      let tableLivColis = [];
      listItems.forEach(item => {
        item.addEventListener('click', function() {
            
            tableLivColis = [];
            const colisLivreurTable = document.getElementById('colisLivreurTable');
            colisLivreurTable.innerHTML = '';
            const itemId = item.id; 
            const colis = @json($colis);
            let matchedColis = [];
            bonDistributions.forEach(bon => {
            if (bon.colis_ids.includes(itemId)) {
              matchedColis = bon.colis_ids;
            }
          });
            matchedColis.forEach(matchedColiId=>{
              const matchedColi = colis.find(coli =>coli.track_number === matchedColiId);
              
              if (matchedColi) {
                tableLivColis.push(matchedColi);
              }
            })

            
            console.log('matched colis : ',tableLivColis);
            
            if(tableLivColis.length > 0){
              colisLivreurTable.parentElement.style.display = "block";
              tableLivColis.forEach(coli => {
              colisLivreurTable.innerHTML += `
              <tr id="${coli.track_number}">
                  <td>
                      <div class="ms-3">
                        <h6 class="fs-4 fw-semibold mb-0">${coli.track_number}</h6>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.client.nom_magasin ?? coli.client.nom}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.ville.nom_ville}</p>
                  </td>
                  <td>
                    <span class="badge bg-success-subtle text-success">${coli.status.nom_status ?? ''}</span>
                  </td>
                  <td>
                    <i class='bx bxs-trash fs-7 delete-colis'></i>
                    </td>
                </tr>
              `;
          });
          attachDeletEvent();
        }
      });
    });
      let valid = document.getElementById('valider-btn')
      if (liste) {
          liste.style.display = bonDistributions.length > 0 ? "block" : "none";
          valid.style.display = bonDistributions.length > 0 ? "block" : "none";
      }
}


  function fillColisTable(){
          const colisList = @json($colis);
          const storedColisRefs = unvalidatedColis()
          const filteredColis = colisList.filter(colis => !storedColisRefs.includes(colis.ref) && colis.id_status == 1);
          
          let colisTable = document.getElementById('colisTable');
          colisTable.innerHTML = "";
          if(filteredColis.length == 0){
            colisTable.innerHTML = `
            <tr>
              <td colspan='10' class="text-center">
                <p>Aucune colis reçue</p>
              </td>  
            </tr>`
          }else{

          
          filteredColis.forEach(coli=>{

            colisTable.innerHTML +=`
              <tr id="${coli.track_number}">
                  <td>
                      <div class="ms-3">
                        <h6 class="fs-4 fw-semibold mb-0">${coli.track_number}</h6>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.date_creation}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.telephone}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.client.nom_magasin ?? coli.utilisateur.nom}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.etat == 1 ? 'paye' : 'Non paye'}</p>
                  </td>
                  <td>
                    <span class="badge bg-success-subtle text-success">${coli.status.nom_status ?? ''}</span>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.ville.nom_ville}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">${coli.prix}</p>
                  </td>
                  
                  <td>
                    <div class="dropdown dropstart">
                      <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical fs-6"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                            <i class="fs-4 ti ti-plus"></i>Add
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                            <i class="fs-4 ti ti-edit"></i>Edit
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                            <i class="fs-4 ti ti-trash"></i>Delete
                          </a>
                        </li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <input type="checkbox" class="form-check-input primary coli-checked" id="">
                    </td>
                </tr>
                `
              
          })
        }
  }



  window.onload = function() {
      fillListeLivreur();
      fillColisTable();
  };

  function removeColis(event){
    let bonDistributions = JSON.parse(localStorage.getItem('bon_distribution')) || [];
    
    const colisRef = event.target.closest('tr').id;

    bonDistributions.forEach(bon=>{
      bon.colis_ids = bon.colis_ids.filter(coli=> coli != colisRef);
    })
    
    bonDistributions = bonDistributions.filter(bon => bon.colis_ids.length > 0);
    console.log(bonDistributions);
    localStorage.setItem('bon_distribution',JSON.stringify(bonDistributions))
    event.target.closest('tr').remove();
    fillColisTable();
    fillListeLivreur();
    updateColisTableVisibility();
  }

  function updateColisTableVisibility() {
    const colisLivreurTable = document.getElementById('colisLivreurTable');
    const tableLivColis = Array.from(colisLivreurTable.querySelectorAll('tr'));
    if (tableLivColis.length === 0) {
        colisLivreurTable.parentElement.style.display = "none";
    }
}

  function attachDeletEvent(){
    document.querySelectorAll('.delete-colis').forEach(icon=>{
        icon.addEventListener('click',removeColis)
    })
  }
  document.getElementById('valider-btn').addEventListener('click',()=>{
    let bonDistributions = JSON.parse(localStorage.getItem('bon_distribution'));
    console.log(bonDistributions);
    fetch('{{route('bonDistr.store')}}',{
      method : 'POST',
      headers : {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body : JSON.stringify({
        bonDistributions : bonDistributions
      })
    })
    .then(response => response.json())
    .then(data => {
      
      localStorage.clear();
  
      window.location.reload();
    })

    .catch(error => {
      console.error('Error:', error);
    });
  });

function showError(inputId, message) {
        const inputField = document.getElementById(inputId);
        const errorSmall = document.createElement("small");
        errorSmall.classList.add("form-control-feedback", "text-danger");
        errorSmall.textContent = message;
        inputField.parentElement.appendChild(errorSmall);
    }

    function unvalidatedColis() {
    const bonDistributions = JSON.parse(localStorage.getItem('bon_distribution')) || [];
    

    const allColisIds = bonDistributions.flatMap(bon => bon.colis_ids);
    
    return allColisIds;
}
</script>

  @endsection

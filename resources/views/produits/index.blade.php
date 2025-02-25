@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<style>

.delete-confirmation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9;
        visibility: hidden;
    }

    .div-confirmation {
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        max-width: 400px;
        width: 100%;
        height: fit-content;
        transition: 1s;
    }

    .showConfirm{
        display: flex !important;
        visibility: visible;
        top: 0;
    }
    .showConfirm .div-confirmation {
        top: 235px;
    }

</style>
<div class="home">
  @include('layouts.sideBar')

  <div class="main pb-5">
    @include('layouts.nav')
      <!-- Success Message -->
              @if(session('success'))
                      <div style="color: green;">
                          {{ session('success') }}
                      </div>
              @endif
                <!-- error Message -->
              @if(session('error'))
                    <div style="color: red;">
                        {{ session('error') }}
                    </div>
              @endif
              <!-- End Message -->
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
                <form class="mt-4">
                <div class="form-group">
                  <div class="row">
                  <div class="col-md-4">
                    <div class="">
                    <input type="text" class="form-control" placeholder="Rechercher coli">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-3">
                    <select class="select2 form-control">
                      <option value="">Etat</option>
                      <option value="">Option1</option>
                      <option value="">Option1</option>
                    </select>
                    </div>
                  </div>



                  <div class="col-md-4">
                    <div class="mb-3">
                    <select class="select2 form-control">
                      <option value="">Status</option>
                      <option value="">Option1</option>
                      <option value="">Option1</option>
                    </select>
                    </div>
                  </div>
                  </div>



                  <div class="row">
                  <div class="col-md-4">
                    <select class="select2 form-control">
                    <option value="">Livreur</option>
                    <option value="">Option1</option>
                    <option value="">Option1</option>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <select class="select2 form-control">
                    <option value="">Dernier mise a jour</option>
                    <option value="">Option1</option>
                    <option value="">Option1</option>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <input type="date" class="form-control" value="2025-01-03">
                  </div>
                  </div>
                </div>
                <div class="form-actions mt-3">
                  <div class="d-flex justify-content-end gap-6">
                  <button type="submit" class="btn btn-primary ">
                    Submit
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

    <div class="card right-side mx-lg-3 mt-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Liste des produits</h4>
          <a href="{{route('clients.produit.create')}}" class="btn btn-success mb-0">Ajouter</a>
        </div>
      </div>
    </div>

    <div class="card-body mx-lg-3 mt-4">
      <div class="table-responsive border rounded">
        <table id="row_group" class="table w-100 table-striped table-bordered display text-nowrap dataTable"
          aria-describedby="row_group_info">
          <thead>
            <!-- start row -->
            <tr class="text-center">
              <th>image Produit</th>
              <th>Nom Produit</th>
              <th>Varainte</th>
              <th>SKU</th>
              <th>Quantite</th>
              <th>Nom business</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <!-- end row -->
          </thead>
          <tbody>
            @if ($produits->isEmpty())
        <tr class="text-center">
          <td colspan="8">Vous n'avez aucun produit</td>
        </tr>
      @else
    @foreach ($produits as $p)
    <tr class="odd text-center">
      <td class="text-center" style="vertical-align: middle">
      <img height="100" src="https://fakeimg.pl/450x450/" alt="{{$p->nom_produit}}">
      </td>
      <td class="text-center" style="vertical-align: middle">{{$p->nom_produit}}</td>
      @if ($p->varainte->isEmpty())
      <td style="vertical-align: middle">Ce produit n'a pas de variante </td>
      <td style="vertical-align: middle"> {{ $p->SKU }} </td>
      <td style="vertical-align: middle"> {{ $p->quantite }} </td>
        @else
          <td style="vertical-align: middle"> <ul>
              @foreach ($p->varainte as $v)
                <li class="py-1"> {{$v->nom_varainte}}</li>
              @endforeach
          </ul> </td>
          <td style="vertical-align: middle"> <ul>
              @foreach ($p->varainte as $v)
              <li class="py-1"> {{$v->SKU}}</li>
              @endforeach
          </ul> </td>
          <td style="vertical-align: middle"> <ul>
                @foreach ($p->varainte as $v)
                  <li class="py-1"> {{$v->quantite}}</li>
                @endforeach
            </ul> </td>
            @endif
            
            <td style="vertical-align: middle">{{$p->business->nom_business}}</td>
            @if ($p->varainte->isEmpty())
              <td class="text-center" style="vertical-align: middle">
                <span class="badge {{ $p->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $p->status ? 'Recu' : 'No Recu' }}</span>
              </td>
            @else
              <td style="vertical-align: middle"> <ul>
                    @foreach ($p->varainte as $v)
                      <li class="py-1"> {{$v->status}}</li>
                    @endforeach
                </ul> </td>
            
            @endif
      <td class="text-center" style="vertical-align: middle">
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
        <a class="dropdown-item d-flex align-items-center gap-3" href="{{route('clients.produit.edit', $p->id)}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
        <path d="M16 5l3 3" />
        </svg>
        Edit
        </a>
      </li>
      <li>
        <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0);" 
              onclick="deleteConfirmation({{ $p->id }})">
                  <i class='bx bxs-trash fs-7'></i>
                  Delete
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
      {{ $produits->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

{{-- Start Div Confirmation --}}
<div id="deleteConfirmation" class="delete-confirmation">
    <div class="div-confirmation">
        <p>Are you sure you want to delete this Produit?</p>
        <button class="btn btn-danger mt-3 me-2" id="confirmDelete" onclick="deleteProduit()">Yes, Delete</button>
        <button class="btn btn-secondary mt-3 ms-2" id="cancelDelete" onclick="cancelDelete()">Cancel</button>
    </div>
</div>
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
{{-- End Div Confirmation --}}


<script>
  let idProduit = null;
    
    function deleteConfirmation(id) {
        idProduit = id;
        document.getElementById('deleteConfirmation').classList.add('showConfirm');
    }

    function cancelDelete() {
        document.getElementById('deleteConfirmation').classList.remove('showConfirm');
    }

    function deleteProduit() {
        const deleteForm = document.getElementById('deleteForm');
        if(idProduit != null){
            deleteForm.action = '/client/stock/produit/' + idProduit;
            deleteForm.submit();
        }
    }
</script>

@endsection
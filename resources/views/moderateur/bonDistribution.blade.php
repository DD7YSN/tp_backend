@extends('layouts.master2')
@section('content')
    <div class="home">
      @include('layouts.sideBarModerateur')
    
    <div class="main">
      @include('layouts.nav')
      <div class="mx-3">              
        <div class="acc-filter">
          <div class="colis-filter">
            <div class="accordion mt-3" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    Filtrer
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form class="mt-4">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="">
                              <input type="text" class="form-control" placeholder="Rechercher coli">
                            </div>
                          </div>
  
                          <div class="col-md-6">
                                <div class="mb-3">
                                  <select class="select2 form-control">
                                    <option value="">Livreur</option>
                                    <option value="">Option1</option>
                                    <option value="">Option1</option>
                                  </select>
                                </div>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col-md-6">
                          <div class="mb-3">
                            <select class="select2 form-control">
                              <option value="">Status</option>
                              <option value="">Option1</option>
                              <option value="">Option1</option>
                            </select>
                          </div>
                        </div>

                          <div class="col-md-6">
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
                        
                     </div>
  
                     
                  </form>
                  </div>
                </div>
              </div>
      
      <div class="ajt-bonDistribution text-end me-4">
        <a href="{{route('bonDistr.create')}}"><button class="btn btn-success mt-3 ">Ajouter Bon de distribution</button></a>
      </div>
      <p>ID Ville: {{ $id_ville }}</p>
      
      <div class="table-cont mx-auto">
        <div class="table-responsive">
          <div class="table-responsive mb-4 border rounded-1 mt-4">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Reference</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Date D'expedition</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Livreur</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Zone</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Statut</h6>
                  </th>
                  <th>
                    <h6 class="fs-4 fw-semibold mb-0">Colis</h6>
                  </th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                @if ($bonDistributions->isEmpty())
                  <tr>
                    <td class="text-center" colspan="7">Aucune Bon distribution</td>
                  </tr>
                  @else
                @foreach ($bonDistributions as $item)
                <tr>
                  <td>
                      <div class="ms-3">
                        <h6 class="fs-4 fw-semibold mb-0">{{$item->ref}}</h6>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">{{$item->date}}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">{{$item->livreur->nom}}</p>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">
                      @if ($item->coli->isNotEmpty() && $item->coli->first()->ville && $item->coli->first()->ville->zone)
                        {{ $item->coli->first()->ville->zone->nom_zone }}
                      @else
                        N/A
                      @endif</p>
                  </td>
                  <td>
                    <span class="badge bg-success-subtle text-success">{{$item->status == 1 ? "Enregistré" : "Brouillon"}}</span>
                  </td>
                  <td>
                    <p class="mb-0 fw-normal">{{$item->coli()->count()}}</p>
                  </td>
                  <td>
                    <div class="dropdown dropstart">
                      <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical fs-6"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Details de bon
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                              Enregistrer le bon
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                            
                                  Voir en PDF
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
        </div>

    </div>
      
      
      
  </div>
  <div class="modal fade" id="exampleModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details du bon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <th>Ref</th>
            <th>Ref</th>
            <th>Ref</th>
          </thead>
          <tr>
            <td>AA</td>
            <td>AA</td>
            <td>AA</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

@endsection
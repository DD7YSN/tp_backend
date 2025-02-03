@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
  @include('layouts.sideBar')

  <div class="main pb-5">
    @include('layouts.nav')
    <div class="card right-side mx-lg-3 mt-5">
      <div class="card-body">
        <div class="mb-2">
          <h4 class="card-title mb-0">Colis Non Expedies</h4>
        </div>
        <div class="table-responsive">
          <table id="row_group" class="table w-100 table-striped table-bordered display text-nowrap dataTable"
            aria-describedby="row_group_info">
            <thead>
              <!-- start row -->
              <tr>
                <th>code Suivi</th>
                <th>Business</th>
                <th>Destinataire</th>
                <th>Etat</th>
                <th>Status</th>
                <th>Ville</th>
                <th>prix</th>
                <th>information</th>
                <th>
                  <span>D.M.L</span>
                  |
                  <span>D.L</span>
                </th>
                <th>action</th>
              </tr>
              <!-- end row -->
            </thead>
            <tbody>

              @if ($colis->isEmpty())
          <tr>
          <td class="text-center" colspan="10">
            Aucune Colis
          </td>
          </tr>

        @else
        @foreach ($colis as $coli)
      <tr class="odd">
      <td>{{$coli->track_number}}</td>
      <td>{{$coli->business->nom_business}}</td>
      <td>{{$coli->destinataire}}</td>
      <td>
        <span style="padding: 6px 15px;" class="alert alert-info text-info">
        {{$coli->etat ? 'Paye' : 'Non Paye' }}
        </span>
      </td>
      <td>

        <span style="padding: 6px 15px;" class="alert alert-warning text-warning">
        Attender Ramassage
        </span>
      </td>
      <td>{{$coli->ville->nom_ville}} - {{$coli->adresse}}</td>
      <td>{{$coli->prix}} DH</td>
      <td>{{$coli->marchandise}}</td>
      <td>{{$coli->date_creation}}
        <span></span>
        |
        <span>2010/03/19</span>
      </td>
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
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
        <li>
        <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M12 5l0 14" />
          <path d="M5 12l14 0" />
          </svg>
          Add
        </a>
        </li>
        <li>
        <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
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
        <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 7l16 0" />
          <path d="M10 11l0 6" />
          <path d="M14 11l0 6" />
          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
          </svg>
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
      </div>
    </div>
  </div>
</div>
</div>
@endsection
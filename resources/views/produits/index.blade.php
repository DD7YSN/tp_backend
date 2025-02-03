@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
  @include('layouts.sideBar')

  <div class="main pb-5">
    @include('layouts.nav')
    <div class="card right-side mx-lg-3 mt-5">
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
      <td style="vertical-align: middle">
      <ul>
      @foreach ($p->varainte as $v)
      <li class="py-1"> {{$v->nom_varainte}}</li>
    @endforeach
      </ul>
      </td>
      <td style="vertical-align: middle">
      <ul>
      @foreach ($p->varainte as $v)
      <li class="py-1"> {{$v->SKU}}</li>
    @endforeach
      </ul>
      </td>
      <td style="vertical-align: middle">
      <ul>
      @foreach ($p->varainte as $v)
      <li class="py-1"> {{$v->quantite}}</li>
    @endforeach
      </ul>
      </td>
      <td style="vertical-align: middle">{{$p->business->nom_business}}</td>
      <td class="text-center" style="vertical-align: middle">{{ $p->status ? 'Recu' : 'No Recu' }}</td>
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
        <a class="dropdown-item d-flex align-items-center gap-3" href="{{route('produit.edit', $p->id)}}">
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
        <form action="{{route('produit.destroy', $p->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <button class="dropdown-item d-flex align-items-center gap-3">

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
        </button>
        </form>
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



<script>
</script>

@endsection
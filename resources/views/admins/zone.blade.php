@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<style>
    #formAjouterZone {
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

    @media screen and (max-width: 992px) {
        #formAjouterZone {
            width: 90%;
        }

    }
</style>
<div class="home">
    @include('layouts.sideBarAdmin')

    <div class="main">
        @include('layouts.nav')

        <div class="card right-side mx-lg-3 mt-5">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des Zones</h4>
                    <span id="ajouterZone" class="btn btn-success mb-0">Ajouter</span>
                </div>
            </div>
        </div>
        <div class="card-body mx-lg-3 mt-4">
            <div>
                <div class="table-responsive border rounded">
                    <table id="row_group" class="table w-100 table-striped table-bordered display text-nowrap dataTable"
                        aria-describedby="row_group_info">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>#</th>
                                <th>Zone</th>
                                <th>villes</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @foreach ($zoneWithVille as $zone)
                                <tr class="odd" style="vertical-align: middle">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{$zone->nom_zone}}</td>
                                    <td>
                                        @foreach ($zone->ville as $ville)
                                            <p class="mb-0"> - {{$ville->nom_ville}}</p>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropstart">
                                            <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                </svg>

                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3"
                                                        href="{{route('zones.edit', $zone->id)}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('zones.destroy', $zone->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center gap-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
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
                        </tbody>

                    </table>
                </div>
            </div>
            {{ $zoneWithVille->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

</div>

<form id="formAjouterZone" action="{{ route('zones.store') }}" method="POST">
    @csrf
    <h4 class="card-title mb-5 text-center">Ajouter Zone</h4>
    <div class="row">
        <div class="col-md-8">
            <div class="form-floating mb-3">
                <input type="text" name="nom_zone" class="form-control" id="tb-nzone" placeholder="Enter nom zone">
                <label for="tb-ref">Nom Zone</label>
            </div>
        </div>
        <div class="col-12">
            <div class="d-md-flex align-items-center">
                <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                    <button id="annuler" type="reset" class="btn bg-danger-subtle text-danger hstack gap-6">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary hstack gap-6">
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    const ajouterZone = document.getElementById('ajouterZone');
    const annuler = document.getElementById('annuler');
    const formAjouterZone = document.getElementById('formAjouterZone');

    ajouterZone.addEventListener('click', () => {
        formAjouterZone.classList.add('showForm')
    })
    annuler.addEventListener('click', () => {
        formAjouterZone.classList.remove('showForm')
    })
    formAjouterZone.addEventListener('submit', function (event) {
        event.preventDefault();
        if (dataValid()) {
            this.submit();
        }
    })
    function dataValid() {

        const nomZone = document.getElementById('tb-nzone');
        nomZone.classList.remove('is-invalid');
        if (!nomZone.value) {
            nomZone.classList.add('is-invalid');
            return false;
        }
        return true;
    }




</script>
@endsection
@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<style>
    #formAjouterVille {
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
        z-index: 2;
    }

    .showForm {
        top: 50px !important;
        visibility: visible !important;
    }

    @media screen and (max-width: 992px) {
        #formAjouterVille {
            width: 90%;
        }

    }
</style>
<div class="home">
    @include('layouts.sideBarAdmin')
    <div class="main pd-5">
        @include('layouts.nav')

        <div class="card right-side mx-lg-3 mt-5">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des Villes</h4>
                    <span id="ajouterVille" class="btn btn-success mb-0">Ajouter</span>
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
                                <th>Ref</th>
                                <th>Ville</th>
                                <th>Zone</th>
                                <th>Frais Livraison</th>
                                <th>Frais Retour</th>
                                <th>Frais Refus</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @foreach ($villes as $ville)
                                <tr class="odd">
                                    <td>{{$ville->ref}}</td>
                                    <td>{{$ville->nom_ville}}</td>
                                    <td>{{$ville->zone->nom_zone}}</td>
                                    <td>{{$ville->frais_livraison}}</td>
                                    <td>{{$ville->frais_retour}}</td>
                                    <td>{{$ville->frais_refus}}</td>
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
                                                        href="{{route('villes.edit', $ville->id)}}">
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
                                                    <form action="{{route('villes.destroy', $ville->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="dropdown-item d-flex align-items-center gap-3">

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
            {{ $villes->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>



<form id="formAjouterVille" action="{{ route('villes.store') }}" method="POST">
    @csrf
    <h4 class="card-title mb-5 text-center">Ajouter Ville</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" name="ref" class="form-control" id="tb-ref" placeholder="Enter Ref">
                <label for="tb-ref">Ref</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" name="nom_ville" class="form-control" id="tb-nville" placeholder="Enter nom Ville">
                <label for="tb-nville">Ville</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="frais_livraison" value="0" class="form-control" id="tb-fraiL"
                    placeholder="Enter frais livraison">
                <label for="tb-fraiL">Frais livraison</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="frais_retour" value="0" class="form-control" id="tb-fraisRe"
                    placeholder="Enter frais retour">
                <label for="tb-fraisRe">Frais retour</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="frais_refus" value="0" class="form-control" id="tb-fraisR"
                    placeholder="Enter frais refus">
                <label for="tb-fraisR">Frais refus</label>
            </div>
        </div>
        <div class="col-md-6 mx-auto">
            <div class="mb-3">
                <select id="zone" class="form-select" name="id_zone">
                    <option value="" selected="">Choisissez une zone ...</option>
                    @foreach ($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->nom_zone}}</option>
                    @endforeach
                </select>
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
    const ajouterVille = document.getElementById('ajouterVille');
    const annuler = document.getElementById('annuler');
    const formAjouterVille = document.getElementById('formAjouterVille');
    ajouterVille.addEventListener('click', () => {
        formAjouterVille.classList.add('showForm')
        console.log('showForm')
    })
    annuler.addEventListener('click', () => {
        formAjouterVille.classList.remove('showForm')
    })
    formAjouterVille.addEventListener('submit', function (event) {
        event.preventDefault();
        if (dataValid()) {
            this.submit();
        }
    })
    function dataValid() {

        const ref = document.getElementById('tb-ref');
        const nomVille = document.getElementById('tb-nville');
        const fraisL = document.getElementById('tb-fraiL');
        const fraisRe = document.getElementById('tb-fraisRe');
        const fraisR = document.getElementById('tb-fraisR');
        const slcZone = document.getElementById('zone');

        ref.classList.remove('is-invalid');
        nomVille.classList.remove('is-invalid');
        fraisL.classList.remove('is-invalid');
        fraisRe.classList.remove('is-invalid');
        fraisR.classList.remove('is-invalid');
        slcZone.classList.remove('is-invalid');
        let is_valid = true;
        if (!ref.value) {
            ref.classList.add('is-invalid');
            is_valid = false;
        } if (!nomVille.value) {
            nomVille.classList.add('is-invalid');
            is_valid = false;
        } if (isNaN(fraisL.value) || fraisL.value < 0) {
            fraisL.classList.add('is-invalid');
            is_valid = false;
        } if (isNaN(fraisRe.value) || fraisRe.value < 0) {
            fraisRe.classList.add('is-invalid');
            is_valid = false;
        } if (isNaN(fraisR.value) || fraisR.value < 0) {
            fraisR.classList.add('is-invalid');
            is_valid = false;
        } if (isNaN(slcZone.value || slcZone.value <= 0)) {
            slcZone.classList.add('is-invalid')
            is_valid = false;
        }

        return is_valid;
    }
</script>
@endsection
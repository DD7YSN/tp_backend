@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBar')

    <style>
        #ajouterBonRamassage {
            width: 40%;
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
            top: 60px !important;
            visibility: visible !important;
        }

        @media screen and (max-width: 992px) {
            #ajouterBonRamassage {
                width: 90%;
            }

        }
    </style>

    <div class="main pb-5">
        @include('layouts.nav')
        <div class="card right-side mx-lg-4 mt-5">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des Bons Ramassages</h4>
                    <span id="btn-ajouter" class="btn btn-success mb-0">Ajouter bon ramassage</span>
                </div>
            </div>
        </div>
        <div class="card right-side mx-lg-4 mt-4">
            <div class="table-responsive border rounded">

                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#Ref</th>
                            <th scope="col">Date de creation</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ville de ramassage</th>
                            <th scope="col">Colis</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bonsRamassages->isEmpty())
                            <tr>
                                <td class="text-center" colspan="7">
                                    Aucune Bon de ramassage
                                </td>
                            </tr>

                        @else
                                        @foreach ($bonsRamassages as $bonRamassage)
                                                        <tr class="text-center">
                                                            <th>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    {{$bonRamassage->ref_ramassage}}
                                                                </h6>
                                                            </th>
                                                            <td>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    {{$bonRamassage->date}}
                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    @if($bonRamassage->status)
                                                                        <span class="badge rounded-pill text-bg-success">Recu</span>
                                                                    @else
                                                                        <span class="badge rounded-pill text-bg-danger">No Recu</span>
                                                                    @endif
                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    {{$bonRamassage->ville->nom_ville}}
                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    {{count($bonRamassage->coli)}}
                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    @if($bonRamassage->coli->isEmpty())
                                                                        No Colis for this Bon Ramassage
                                                                    @else
                                                                                                @php
                                                                                                    $totalPrix = 0; 
                                                                                                @endphp
                                                                                                @foreach ($bonRamassage->coli as $coli)
                                                                                                                        @php
                                                                                                                            $totalPrix = $totalPrix + $coli->prix
                                                                                                                        @endphp
                                                                                                @endforeach
                                                                                                {{$totalPrix }} DH
                                                                    @endif
                                                                </h6>
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
                                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="">
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
                                                                            <form action="" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button class="dropdown-item d-flex align-items-center gap-3">

                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
        </div>
    </div>
</div>

<div id="ajouterBonRamassage" class="mb-3 d-flex flex-column justify-content-between align-items-center gap-6">
    @if (count($noRamasse) > 0)
        <span class="badge  bg-info-subtle text-info py-2 px-3 mb-3"> ( {{count($noRamasse)}} ) Colis Pret la
            preparation</span>
    @else
        <span class="badge  bg-danger-subtle text-danger py-2 px-3 mb-3"> ( {{count($noRamasse)}} ) Colis Pret la
            preparation</span>

    @endif
    <div class="d-flex gap-6 mx-auto mt-3 mt-md-0">
        <button id="annuler" type="reset" class="btn bg-danger-subtle text-danger hstack gap-6">
            Annuler
        </button>
        <a href="{{route('bon_ramassage.create')}}" class="btn btn-success mb-0">Ajouter bon ramassage</a>
    </div>
</div>
<script>
    const btn_ajouter = document.getElementById('btn-ajouter');
    const annuler = document.getElementById('annuler');
    const ajouterBonRamassage = document.getElementById('ajouterBonRamassage');
    btn_ajouter.addEventListener('click', () => {
        ajouterBonRamassage.classList.add('showForm')
    })
    annuler.addEventListener('click', () => {
        ajouterBonRamassage.classList.remove('showForm')
    })
</script>
@endsection
@extends('layouts.master')
@section('title', 'Client | Livraison')

@section('content')
<style>
    #formAjouterBusiness {
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
        top: 50px !important;
        visibility: visible !important;
    }

    @media screen and (max-width: 992px) {
        #formAjouterBusiness {
            width: 90%;
        }

    }
</style>

<div class="home">
    @include('layouts.sideBar')

    <div class="main pb-5">
        @include('layouts.nav')
        <div class="card right-side mx-lg-4 mt-5">
            <div id="ajouterColi" class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des Businesses</h4>
                    <span id="ajouterBusiness" class="btn btn-success mb-0">Ajouter</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mx-lg-3 my-lg-5">
            @if (!empty($business))
                @foreach ($business as $b)
                    <div class="col-lg-4 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mt-n2">
                                    <span class="badge text-bg-primary">{{ strtoupper($b->ref) }}</span>
                                    <h3 class="card-title mt-3">{{ $b->nom_business }}</h3>
                                    <p class="card-subtitle">{{ $b->telephone }}</p>
                                </div>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-6">
                                        <div class="py-2 px-3 text-bg-light rounded-1 d-flex align-items-center">
                                            <span class="text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                    <path d="M12 12l8 -4.5" />
                                                    <path d="M12 12l0 9" />
                                                    <path d="M12 12l-8 -4.5" />
                                                </svg>

                                                Colis :
                                            </span>
                                            <div class="ms-2 text-start">

                                                <h4 class="mb-0 fs-5">{{ count($b->coli) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="py-2 px-3 text-bg-light rounded-1 d-flex align-items-center">
                                            <span class="text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-google-play">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 3.71v16.58a.7 .7 0 0 0 1.05 .606l14.622 -8.42a.55 .55 0 0 0 0 -.953l-14.622 -8.419a.7 .7 0 0 0 -1.05 .607z" />
                                                    <path d="M15 9l-10.5 11.5" />
                                                    <path d="M4.5 3.5l10.5 11.5" />
                                                </svg>

                                                in Stock :
                                            </span>
                                            <div class="ms-2 text-start">

                                                <h4 class="mb-0 fs-5">{{ count($b->produit) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
    </div>
</div>

<form id="formAjouterBusiness" class="card" action="{{ route('business.store') }}" method="POST">
    @csrf
    <h4 class="card-title mb-5 text-center">Ajouter Business</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" name="ref" class="form-control" id="tb-ref" placeholder="Enter Ref business">
                <label for="tb-ref">Ref Business</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" name="nom_business" class="form-control" id="tb-nomb"
                    placeholder="Enter nom business">
                <label for="tb-ref">Nom Business</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" name="telephone" class="form-control" id="tb-tele" placeholder="Enter telephone">
                <label for="tb-tele">Telephone</label>
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
    const formAjouterBusiness = document.getElementById("formAjouterBusiness");
    const ajouterBusiness = document.getElementById('ajouterBusiness');
    const annuler = document.getElementById('annuler');
    ajouterBusiness.addEventListener('click', () => {
        formAjouterBusiness.classList.add('showForm')
    })
    annuler.addEventListener('click', () => {
        formAjouterBusiness.classList.remove('showForm')
    })
    formAjouterBusiness.addEventListener("submit", function (event) {
        const ref = document.getElementById("tb-ref").value;
        const nomBusiness = document.getElementById("tb-nomb").value;
        const telephone = document.getElementById("tb-tele").value;

        const errorMessages = document.querySelectorAll(".form-control-feedback");
        errorMessages.forEach(msg => msg.remove());

        if (!ref || ref.trim() === "") {
            event.preventDefault();
            showError("tb-ref", "La référence de Business est requise");
        } else if (ref.length > 5) {
            event.preventDefault();
            showError("tb-ref", "La référence ne doit pas dépasser 5 caractères.");
        }
        if (!nomBusiness || nomBusiness.trim() === "") {
            event.preventDefault();
            showError("tb-nomb", "Le nom de Business est requis");
        }
        if (!telephone || !/^\+212\d{9}$/.test(telephone)) {
            event.preventDefault();
            showError("tb-tele", "Le numéro de téléphone doit commencer par +212 et être suivi de 9 chiffres");
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
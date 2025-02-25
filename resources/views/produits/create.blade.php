@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBar')

    <div class="main">
        @include('layouts.nav')

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="card right-side mx-lg-3 my-lg-5">
            <div class="card-body">

                <form id="formAjouterProduit" action="{{ route('clients.produit.store') }}" method="POST">
                    @csrf
                    <h4 class="card-title mb-5 text-center">Ajouter du Produit</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="nom_produit" class="form-control" id="nomProduit"
                                    placeholder="Nom Produit">
                                <label for="nomProduit">Nom Produit</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="SKU" class="form-control" id="sku"
                                    placeholder="Ref du produit">
                                <label for="sku">#Ref du produit</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" name="quantite" class="form-control" id="qteProduit"
                                    placeholder="Quantite">
                                <label for="qte">Quantite</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="note" class="form-control" id="note"
                                    placeholder="Enter frais retour">
                                <label for="note">Note</label>
                            </div>
                        </div>

                        <div class="col-md-6 mx-auto">
                            <div class="mb-3">
                                <select id="business" class="form-select" name="id_business">
                                    <option selected="" value="-1">Choisissez une business ...</option>
                                    @foreach ($business as $b)
                                        <option value="{{$b->id}}">{{$b->nom_business}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button onclick="education_fields();" class="btn btn-success fw-medium" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Ajouter variante
                            </button>
                        </div>
                        <div id="education_fields">

                        </div>
                        <div class="col-12">
                            <div class="d-md-flex align-items-center">
                                <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                                    <a id="annuler" href="{{ route('clients.produit.index') }}" type="reset"
                                        class="btn bg-danger-subtle text-danger hstack gap-6">
                                        Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary hstack gap-6">
                                        Ajouter
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let variantCount = 0;

    // Function to add variant fields
    window.education_fields = function () {
        variantCount++;
        const fields = `
            <div id="variant${variantCount}" class="row variant-field">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" id="nom_varainte-${variantCount}" name="nom_varainte" placeholder="Nom varainte"></div>
                </div>
                <div class="col-sm-4 mb-3"> <div class="form-group">
                    <input type="text" class="form-control" id="sku-${variantCount}" name="SKU" placeholder="SKU">
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control" id="qte-${variantCount}" name="quantite" placeholder="Quantite">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button class="btn btn-danger" type="button" onclick="remove_education_fields('${variantCount}' );">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-minus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
                    </button>
                </div>
            </div>
            </div>
        `;
        document.getElementById('education_fields').insertAdjacentHTML('beforeend', fields);
    };

    window.remove_education_fields = function (id) {
        const variantField = document.getElementById(`variant${id}`);
        if (variantField) {
            variantField.remove();
        }
    };

    document.getElementById('formAjouterProduit').addEventListener('submit', function (event) {
        let isValid = true;

        const errorMessages = document.querySelectorAll(".form-control-feedback");
                errorMessages.forEach(msg => msg.remove());

                const nomProduit = document.getElementById('nomProduit').value.trim();
        if (nomProduit === '') {
            showError('nomProduit', 'Veuillez entrer le nom du produit.');
            isValid = false;
        }

        const sku = document.getElementById('sku').value.trim();
        if (sku === '') {
            showError('sku', 'Veuillez entrer la référence du produit (SKU).');
            isValid = false;
        }

        const quantite = document.getElementById('qteProduit').value.trim();
        if (quantite === '' || isNaN(quantite)) {
            showError('qteProduit', 'Veuillez entrer une quantité valide.');
            isValid = false;
        }

        const business = document.getElementById('business').value;
        if (business === '' || business == '-1' ) {
            showError('business', 'Veuillez choisir une business.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }

        const variantFields = document.querySelectorAll('.variant-field');
        variantFields.forEach((field, index) => {
            
            const nomVariantInput = field.querySelector('input[name*="nom_varainte"]');
            const skuVariantInput = field.querySelector('input[name*="SKU"]');
            const quantiteVariantInput = field.querySelector('input[name*="quantite"]');
            
            const nomVariant = nomVariantInput.value.trim();
            const skuVariant = skuVariantInput.value.trim();
            const quantiteVariant = quantiteVariantInput.value.trim();
            
            if (nomVariant === '') {
                showError(nomVariantInput.id, 'Veuillez entrer le nom de la variante.');
                isValid = false;
            }

            if (skuVariant === '') {
                showError(skuVariantInput.id, 'Veuillez entrer la référence du produit (SKU).');
                isValid = false;
            }

            if (quantiteVariant === '' || isNaN(quantiteVariant)) {
                showError(quantiteVariantInput.id, 'Veuillez entrer une quantité valide.');
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
    function showError(inputId, message) {
        const inputField = document.getElementById(inputId);
        const errorSmall = document.createElement("small");
        errorSmall.classList.add("form-control-feedback", "text-danger");
        errorSmall.textContent = message;
        inputField.parentElement.appendChild(errorSmall);
    }
});
</script>

@endsection
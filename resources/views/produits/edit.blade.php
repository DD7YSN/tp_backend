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



      <div class="card right-side mx-lg-3 my-lg-5">
    <div class="card-body">
<div class="card right-side mx-lg-3 my-lg-5">
    <div class="card-body">
        <form id="formEditProduit" action="{{ route('clients.produit.update', $produit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h4 class="card-title mb-5 text-center">Modifier Produit</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="nom_produit" class="form-control" id="nomProduit" 
                               placeholder="Nom Produit" value="{{ old('nom_produit', $produit->nom_produit) }}">
                        <label for="nomProduit">Nom Produit</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="SKU" class="form-control" id="sku" 
                               placeholder="Référence du produit" value="{{ old('SKU', $produit->SKU) }}">
                        <label for="sku">#Référence du produit</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" name="quantite" class="form-control" id="qteProduit"
                               placeholder="Quantité" value="{{ old('quantite', $produit->quantite) }}">
                        <label for="qteProduit">Quantité</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="note" class="form-control" id="note"
                               placeholder="Note" value="{{ old('note', $produit->note) }}">
                        <label for="note">Note</label>
                    </div>
                </div>

                <!-- Displaying Business Dropdown -->
                <div class="col-md-6 mx-auto">
                    <div class="mb-3">
                        <select id="business" class="form-select" name="id_business">
                            <option selected="" value="-1">Choisissez une business...</option>
                            @foreach ($business as $b)
                                <option value="{{ $b->id }}" 
                                        @if(old('id_business', $produit->id_business) == $b->id) selected @endif>
                                    {{ $b->nom_business }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Variant Fields Section -->
                <div class="col-md-12 mb-3">
                    <button onclick="education_fields();" class="btn btn-success fw-medium" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14"/>
                            <path d="M5 12l14 0"/>
                        </svg>
                        Ajouter variante
                    </button>
                </div>

                <!-- Displaying Existing Variants -->
                <div id="education_fields">
                    @foreach ($produit->varainte as $variant)
                        <div id="variant{{ $variant->id }}" class="row variant-field">
                            <div class="col-sm-4 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="variants[{{ $variant->id }}][nom_varainte]"
                                           value="{{ old('variants.' . $variant->id . '.nom_varainte', $variant->nom_varainte) }}"
                                           placeholder="Nom variante">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="variants[{{ $variant->id }}][SKU]"
                                           value="{{ old('variants.' . $variant->id . '.SKU', $variant->SKU) }}"
                                           placeholder="SKU">
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="variants[{{ $variant->id }}][quantite]"
                                           value="{{ old('variants.' . $variant->id . '.quantite', $variant->quantite) }}"
                                           placeholder="Quantité">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <button class="btn btn-danger" type="button" onclick="remove_education_fields('{{ $variant->id }}');">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-minus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l14 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit & Cancel -->
                <div class="col-12">
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                            <a id="annuler" href="{{ route('clients.produit.index') }}" type="reset"
                               class="btn bg-danger-subtle text-danger hstack gap-6">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary hstack gap-6">
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    // Function to dynamically add variant fields
    document.addEventListener('DOMContentLoaded', function () {
        let variantCount = {{ $produit->varainte->count() }};
        
        window.education_fields = function () {
            variantCount++;
            const fields = `
                <div id="variant${variantCount}" class="row variant-field">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="variants[${variantCount}][nom_varainte]" placeholder="Nom variante">
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="variants[${variantCount}][SKU]" placeholder="SKU">
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="form-group">
                            <input type="number" class="form-control" name="variants[${variantCount}][quantite]" placeholder="Quantité">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button class="btn btn-danger" type="button" onclick="remove_education_fields('${variantCount}');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-minus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 12l14 0"/>
                                </svg>
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
    });
</script>

@endsection
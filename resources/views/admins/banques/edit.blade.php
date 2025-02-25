@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<style>
    .simplebar-scrollable-x {
        height: 300px;
        overflow-y: auto;
    }

    .simplebar-content-wrapper {
        overflow-y: auto;
        height: 100%;
    }

    #dash-card-items {
        height: fit-content !important;
    }
</style>
<div class="home">
    @include('layouts.sideBarAdmin')
    <div class="main pb-5">
            @include('layouts.nav')


            <div class="card right-side mx-lg-3 mt-3 p-3">
                <form id="formAjouterBanque" action="{{ route('banques.store') }}" method="POST">
                    @csrf
                    <h4 class="card-title mb-3 text-center">Ajouter Banque</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" name="nom_banque" class="form-control" id="tb-nbanque" value="{{ old('nom_banque', $banque->nom_banque) }}" placeholder="Enter nom banque">
                                <label for="tb-ref">Nom Banque</label>
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
        </div>
    </div>
</div>
<script>
    function validateForm() {
        const nomBanque = document.getElementById("nom_banque").value;
        const errorMessage = document.getElementById("error-message");
        
        if (nomBanque.trim() === "") {
            errorMessage.innerText = "Nom Banque is required.";
            return false;
        }
        
        if (nomBanque.length > 30) {
            errorMessage.innerText = "Nom Banque should not exceed 30 characters.";
            return false;
        }
        
        return true;
    }
</script>
@endsection
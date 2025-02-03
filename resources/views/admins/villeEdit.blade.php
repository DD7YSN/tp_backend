@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBarAdmin')

    <div class="main pb-5">
        @include('layouts.nav')

        <div class="card right-side mx-lg-3 mt-5 p-3">
            <form id="formAjouterVille" action="{{ route('villes.update', $ville->id) }}" method="POST">
                @method('PUT')
                @csrf
                <h4 class="card-title mb-5 text-center">Modifier Ville</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" value="{{old('ref', $ville->ref)}}" name="ref" class="form-control"
                                id="tb-ref" placeholder="Enter Ref">
                            <label for="tb-ref">Ref</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" value="{{old('nom_ville', $ville->nom_ville)}}" name="nom_ville"
                                class="form-control" id="tb-nville" placeholder="Enter nom Ville">
                            <label for="tb-nville">Ville</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" step="0.01" value="{{old('frais_livraison', $ville->frais_livraison)}}"
                                name="frais_livraison" class="form-control" id="tb-fraiL"
                                placeholder="Enter frais livraison">
                            <label for="tb-fraiL">Frais livraison</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" step="0.01" value="{{old('frais_retour', $ville->frais_retour)}}"
                                name="frais_retour" class="form-control" id="tb-fraisRe"
                                placeholder="Enter frais retour">
                            <label for="tb-fraisRe">Frais retour</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" step="0.01" value="{{old('frais_refus', $ville->frais_refus)}}"
                                name="frais_refus" class="form-control" id="tb-fraisR" placeholder="Enter frais refus">
                            <label for="tb-fraisR">Frais refus</label>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <select id="zone" class="form-select" name="id_zone">
                                <option selected=>Choisissez une zone ...</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @if($zone->id == $ville->id_zone) selected @endif>
                                        {{ $zone->nom_zone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-md-flex align-items-center">
                            <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                                <a href="{{route('villes.index')}}" type="reset"
                                    class="btn bg-danger-subtle text-danger hstack gap-6">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-success hstack gap-6">
                                    Modifier
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
        }
        if (!nomVille.value) {
            nomVille.classList.add('is-invalid');
            is_valid = false;
        }
        if (isNaN(fraisL.value) || fraisL.value < 0) {
            fraisL.classList.add('is-invalid');
            is_valid = false;
        }
        if (isNaN(fraisRe.value) || fraisRe.value < 0) {
            fraisRe.classList.add('is-invalid');
            is_valid = false;
        }
        if (isNaN(fraisR.value) || fraisR.value < 0) {
            fraisR.classList.add('is-invalid');
            is_valid = false;
        }
        if (isNaN(slcZone.value || slcZone.value <= 0)) {
            slcZone.classList.add('is-invalid')
            is_valid = false;
        }

        return is_valid;
    }




</script>
@endsection
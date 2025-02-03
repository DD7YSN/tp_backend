@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBarAdmin')

    <div class="main pd-5">
    @include('layouts.nav')

        <div class="card mx-lg-3 mt-5">
            <div class="card-body">
              <h4 class="card-title mb-3">Information General</h4>
              <form id="globalForm" action="{{route('general.update', $general->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-body">
                    <h3>Informations</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nom de l'entreprise </label>
                            <div class="mb-3">
                                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de l'entreprise">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Web site </label>
                            <div class="mb-3">
                                <input type="text" id="site_lien" name="site_lien" class="form-control" placeholder="Web site">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telephone de l'entreprise </label>
                            <div class="mb-3">
                                <input type="text" id="telephone_a" name="telephone_a" class="form-control" placeholder="Telephone de l'entreprise">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telephone de l'entreprise 2</label>
                            <div class="mb-3">
                                <input type="text" id="telephone_b" name="telephone_b" class="form-control" placeholder="Telephone de l'entreprise 2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fix de l'entreprise</label>
                            <div class="mb-3">
                                <input type="text" id="fix" name="fix" class="form-control" placeholder="fix de l'entreprise">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email de l'entreprise</label>
                            <div class="mb-3">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email de l'entreprise">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Monnie de l'application</label>
                            <div class="mb-3">
                                <select id="id_monnie" class="form-select" name="id_monnaie">
                                    <option selected="">Choisissez monnaie de l'application ...</option>
                                    @foreach ($monnies as $m)
                                    <option value="{{ $m->id }}" @if($m->id == $general->id_monnie) selected @endif> {{ $m->nom_monnie }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lien administrateur</label>
                            <div class="mb-3">
                                <input type="text" id="site_admin" name="site_admin" class="form-control" placeholder="Lien administrateur">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lien clients</label>
                            <div class="mb-3">
                                <input type="text" id="site_client" name="site_client" class="form-control" placeholder="Lien administrateur">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Zone Principal</label>
                            <div class="mb-3">
                                <select id="zone_principal" class="form-select" name="id_monnaie">
                                    <option selected="">Choisissez monnaie de l'application ...</option>
                                    @foreach ($zones as $z)
                                    <option value="{{ $z->id }}" @if($z->id == $general->zone_principal) selected @endif> {{ $z->nom_zone }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                                <div class="col-md-6">
                            <label class="form-label">Adresse de l'enterprise </label>
                            <div class="mb-3">
                                <input type="text" id="adresse" name="adresse" class="form-control" placeholder="adresse">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions d-md-flex align-items-center">
                  <div class="d-flex ms-auto gap-6">
                        <button type="reset" class="btn bg-danger-subtle text-danger ">
                          Reset
                        </button>
                        <button type="submit" class="btn btn-success  me-6">
                            Modifier
                        </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>
</div>


<script>
    document.getElementById('globalForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if(dataValid()){
            this.submit();
        }
        });
        
        
    function dataValid() {
        const nom = document.getElementById('nom');
        const idMonnie = document.getElementById('id_monnie');
        const telephoneA = document.getElementById('telephone_a');
        const telephoneB = document.getElementById('telephone_b');
        const fix = document.getElementById('fix');
        const email = document.getElementById('email');
        const siteLien = document.getElementById('site_lien');
        const lienAdmin = document.getElementById('site_admin');
        const lienClient = document.getElementById('site_client');
        const zonePrincipal = document.getElementById('zone_principal');
        const adresse = document.getElementById('adresse');
        let is_valid = true;
        nom.classList.remove('is-ivalid');
        idMonnie.classList.remove('is-ivalid');
        telephoneA.classList.remove('is-ivalid');
        telephoneB.classList.remove('is-ivalid');
        fix.classList.remove('is-ivalid');
        email.classList.remove('is-ivalid');
        siteLien.classList.remove('is-ivalid');
        lienAdmin.classList.remove('is-ivalid');
        lienClient.classList.remove('is-ivalid');
        zonePrincipal.classList.remove('is-ivalid');
        adresse.classList.remove('is-ivalid');
        
        if (nom.value.length === 0 || !/^[a-zA-Z\s]+$/.test(nom.value) || nom.value.length > 25) {
            nom.classList.add('is-invalid');
            is_valid = false;
        }
        if (siteLien.value.length === 0 || !/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/.test(siteLien.value) || siteLien.value.length > 255) {
            siteLien.classList.add('is-invalid');
            is_valid = false;
        }
        if (telephoneA.value.length === 0 || !/^\d{10,15}$/.test(telephoneA.value)) {
            telephoneA.classList.add('is-invalid');
            is_valid = false;
        }
        if (telephoneB.value.length > 0 && !/^\d{10,15}$/.test(telephoneB.value)) {
            telephoneB.classList.add('is-invalid');
            is_valid = false;
        }
        if (fix.value.length > 0 && fix.value.length > 20) {
            fix.classList.add('is-invalid');
            is_valid = false;
        }
        if (email.value.length === 0 || !/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value) || email.value.length > 40) {
            email.classList.add('is-invalid');
            is_valid = false;
        }
        if (idMonnie.value.length === 0 || isNaN(idMonnie.value)) {
            idMonnie.classList.add('is-invalid')
            is_valid = false;
        }
        if (lienAdmin.value.length === 0 || !/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/.test(lienAdmin.value) || lienAdmin.value.length > 255) {
            lienAdmin.classList.add('is-invalid');
            is_valid = false;
        }
        if (lienClient.value.length === 0 || !/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/.test(lienClient.value) || lienClient.value.length > 255) {
            lienClient.classList.add('is-invalid');
            is_valid = false;
        }
        if (zonePrincipal.value.length === 0 || isNaN(zonePrincipal.value)) {
            zonePrincipal.classList.add('is-invalid');
            is_valid = false;
        }
        if (adresse.value.length === 0 || adresse.value.length > 255) {
            adresse.classList.add('is-invalid');
            is_valid = false;
        }
        console.log(idMonnie)
        return is_valid;
    };


</script>
@endsection
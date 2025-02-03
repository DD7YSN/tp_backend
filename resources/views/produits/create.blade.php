@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBar')

    <div class="main">
        @include('layouts.nav')
        <div class="card right-side mx-lg-3 my-lg-5">
            <div class="card-body">

                <form id="formAjouterProduit" action="{{ route('villes.store') }}" method="POST">
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
                                <input type="number" name="quantite" value="0" class="form-control" id="qteProduit"
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
                                    <option selected="">Choisissez une business ...</option>
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
                                    <button id="annuler" type="reset"
                                        class="btn bg-danger-subtle text-danger hstack gap-6">
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
                </>
            </div>
        </div>
    </div>
</div>


<script>

    const formAjouterVille = document.getElementById('formAjouterVille');

    formAjouterProduit.addEventListener('submit', function (event) {
        event.preventDefault();
        if (dataValid()) {
            this.submit();
        }
    })


    let room = 1;
    function education_fields() {
        if (document.querySelectorAll('#education_fields form.row').length === 0) {
            document.getElementById("qteProduit").setAttribute('disabled', true);
        };
        room++;
        let objTo = document.getElementById("education_fields");
        let divtest = document.createElement("div");
        divtest.setAttribute("class", "mb-3 removeclass" + room);
        let rdiv = "removeclass" + room;
        divtest.innerHTML =
            `<form class="row">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" id="nom_varainte" name="nom_varainte" placeholder="Nom varainte"></div>
                </div>
                <div class="col-sm-4 mb-3"> <div class="form-group">
                    <input type="text" class="form-control" id="sku" name="SKU" placeholder="SKU">
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control" id="qte" name="quantite" placeholder="Quantite">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button class="btn btn-danger" type="button" onclick="remove_education_fields('${room}' );">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-minus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
                    </button>
                </div>
            </div>
            </form>`;

        objTo.appendChild(divtest);
    }

    function remove_education_fields(rid) {
        if (document.querySelectorAll('#education_fields form.row').length === 1) {
            document.getElementById("qteProduit").removeAttribute('disabled');

        }
        const elements = document.querySelectorAll('.removeclass' + rid);
        elements.forEach(function (element) {
            element.remove();
        });
    }

</script>

@endsection
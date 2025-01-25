@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
      @include('layouts.sideBar')

      <div class="main">
          @include('layouts.nav')
            <div id="ajouterColi" class="card-body p-3">
                <h4 class="card-title mb-3 text-center">Nouveau colis</h4>
                <span>Rotour List colis</span>
                <form class="mt-2" action="{{route('colis.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputDestinataire" class="form-label">Destinataire</label>
                                <input type="text" class="form-control" name="destinataire" id="inputDestinataire" placeholder="Destinataire">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="inputCommande" class="form-label">N Commande</label>
                                    <input type="text" name="bon_ramassage" class="form-control" id="inputCommande" placeholder="N Commande">
                                </div>
                            </div>
                            
                        
                            <div class="col-md-6">
                            <div class=" mb-3">
                                <label for="inputTelephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" name="telephone" id="inputTelephone" min="10" max="15" placeholder="Telephone">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label class="form-label">Ville</label>
                            <select id="slc-ville" class="form-select" name="id_ville" aria-label="Default select example">
                                <option selected="">Ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{$ville->id}}">{{$ville->nom_ville}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label class="form-label">Business</label>
                            <select id="slc-business" class="form-select" name="id_business" aria-label="Default select example">
                                <option selected="">Business</option>
                                @foreach ($business as $b)
                                    <option value="{{$b->id}}">{{$b->nom_business}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputAdresse" class="form-label">Adresse</label>
                                <input type="text" name="adresse" class="form-control" id="inputAdresse" placeholder="Adresse">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class=" mb-3">
                                <label for="inputMarchabdise" class="form-label">Marchandise</label>
                                <input type="text" name="marchandise" class="form-control" id="inputMarchabdise" placeholder="Marchabdise">
                            </div>
                        </div>
            
                        <div class="col-md-6">
                            <div class=" mb-3">
                                <label for="inputQuantite" class="form-label">Quantite</label>
                                <input type="number" class="form-control" id="inputQuantite" placeholder="Quantite">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class=" mb-3">
                                <label for="inputPrix" class="form-label">Prix</label>
                                <input type="number" name="prix" step="0.01" class="form-control" id="inputPrix" placeholder="Prix">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class=" mb-3 ">
                                    <label for="inputCommentaire" class="form-label">Commentaire ( Autre telephone, Date de livraison,..)</label>
                                    <textarea class="form-control" name="commentaire" id="inputCommentaire" cols="20" rows="3" placeholder="Commentaire ( Autre telephone, Date de livraison, ...)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-1">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="ouvrir" id="ouvrirColis">
                                    <label class="form-check-label" for="ouvrirColis">
                                        interdit d'ouvrir le colis
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="colisRemplacer">
                                    <label class="form-check-label" for="colisRemplacer">
                                        Colis a Remplacer
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="colisDuStock">
                                    <label class="form-check-label" for="colisDuStock">
                                        Colis du Stock
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-12 mb-2">
                                <div class="d-md-flex align-items-center">
                                    <div class="ms-auto d-flex mt-3 gap-10 mt-md-0">
                                        <button type="reset" class="btn bg-danger-subtle text-danger hstack gap-6">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                                stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-restore">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.06 13a9 9 0 1 0 .49 -4.087" />
                                                <path d="M3 4.001v5h5" /><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        </svg>
                                        Reinitialiser
                                        </button>

                                        <button type="submit" class="btn btn-primary hstack gap-6">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                                fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="mb-3">
                            <label for="inputAdresse" class="form-label">Frais de livraison: </label>
                            <span>
                                <span id="fraisLivraison">00.00</span> DH
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="inputAdresse" class="form-label">Frais de retour: </label>
                            <span>
                                <span id="fraisRetour">00.00</span> DH
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="inputAdresse" class="form-label">Frais de refus: </label>
                            <span>
                                <span id="fraisRefus">00.00</span> DH
                            </span>
                        </div>
                    </div>
                </form>
            </div>        
    </div>        
</div>


    <script>
        const slc_ville = document.getElementById('slc-ville');
        const fraisLivraison = document.getElementById('fraisLivraison');
        const fraisRetour = document.getElementById('fraisRetour');
        const fraisRefus = document.getElementById('fraisRefus');

        slc_ville.addEventListener('change', () => {
            const id = slc_ville.value;
            fetch('/villes/'+id)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                fraisLivraison.innerText = `${data[0].frais_livraison}.00`;
                fraisRetour.innerText = `${data[0].frais_retour}.00`;
                fraisRefus.innerText = `${data[0].frais_refus}.00`;
            })
            .catch(err => {console.error(err)})
        })
    </script>
@endsection
        <div id="sidebar" class="sidebar">
            <div class="d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-0">
                  <div class="mb-4">
                    <h4 class="card-title mb-0">Menu</h4>
                  </div>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    {{-- Start Row --}}
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                          Colis
                        </button>
                      </h2>
                      <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample" style="">
                        <ul class="accordion-body py-0">
                            <li><a href="{{route('colis.create')}}">Nouveau Colis</a></li>
                            <li><a href="">Liste Colis</a></li>
                          </ul>
                        </div>
                      </div>
                    {{-- End Row --}}
                    {{-- Start Row --}}
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTree">
                          Gestion de stock
                        </button>
                      </h2>
                      <div id="flush-collapseTree" class="accordion-collapse collapse" aria-labelledby="flush-headingTree" data-bs-parent="#accordionFlushExample" style="">
                        <ul class="accordion-body py-0">
                            <li><a href="">Nouveau Colis</a></li>
                            <li><a href="">Pret pour la preparation</a></li>
                            <li><a href="">Bon de livraion (Stock)</a></li>
                            <li><a href="{{route('produit.inventory',1)}}">Inventory</a></li>
                          </ul>
                        </div>
                      </div>
                    {{-- End Row --}}
                    {{-- Start Row --}}
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          Utilisateur
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
                        <ul class="accordion-body py-0">
                            <li><a href="{{route('utilisateur.index')}}">touts</a></li>
                            <li><a href="{{route('utilisateur.role','client')}}">Client</a></li>
                            <li><a href="{{route('utilisateur.role','moderateur')}}">Moderateur</a></li>
                            <li><a href="{{route('utilisateur.role','livreur')}}">Liverur</a></li>
                            <li><a href="{{route('utilisateur.role','admin')}}">Administrateur</a></li>
                            <li><a href="{{route('utilisateur.attendeActivation')}}">En attende d'activation</a></li>
                          </ul>
                        </div>
                      </div>
                    {{-- End Row --}}

                    {{-- Start Row --}}
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Parametres
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                          <ul class="accordion-body py-0">
                            <li><a href="{{route('general.index')}}">general</a></li>
                            <li><a href="{{route('villes.index')}}">villes</a></li>
                            <li><a href="{{route('zones.index')}}">zones</a></li>
                            <li><a href="{{route('villes.index')}}">options</a></li>
                            <li><a href="{{route('villes.index')}}">SMS</a></li>
                            <li><a href="{{route('villes.index')}}">E-mail</a></li>
                          </ul>
                      </div>
                    </div>
                    {{-- End Row --}}
                  </div>
                </div>
              </div>
            </div>
</div>



@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')

<style>
#formAjouterMonnie {
        width: 55%;
        padding: 32px 48px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        position: absolute;
        top: -130%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #FFF;
        transition: 1s;
        visibility: hidden;
        z-index: 9;
    }

    .showForm {
        top: 50px !important;
        visibility: visible !important;
    }

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

    @media screen and (max-width: 992px) {
        #formAjouterMonnie {
            width: 90%;
        }

    }
</style>

<div class="home">
    @include('layouts.sideBarAdmin')
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

        <div class="card right-side mx-lg-3 mt-3">
            <div id="ajouterMonnie" class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des Monnies</h4>
                    <span id="ajouterMonnie" class="btn btn-success mb-0">Ajouter</span>
                </div>
            </div>
        </div>

        <div class="card right-side mx-lg-3 mt-3 p-3">
            <div class="card right-side mx-lg-3 mt-4">
                <div class="table-responsive border rounded">
                <table id="row_group" class="table w-100 table-striped table-bordered display text-nowrap dataTable"
                    aria-describedby="row_group_info">
                    <thead>
                    <!-- start row -->
                    <tr>
                    <th>#</th>
                    <th>Nom Monnie</th>
                    <th>action</th>
                    </tr>
                    <!-- end row -->
                    </thead>
                    <tbody>
                        @if ($monnies->isEmpty())
                        <tr>
                            <td colspan="2">No Monnies found.</td>
                        </tr>
                        @else
                            @foreach ($monnies as $key => $m)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $m->nom_monnie }}</td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        </svg>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('monnies.edit', $m->id) }}">
                                                    <i class='mx bxs-edit fs-7'></i>
                                                    edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0);" 
                                                onclick="deleteConfirmation({{ $m->id }})">
                                                    <i class='bx bxs-trash fs-7'></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            <tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $monnies->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Start Div Confirmation --}}
<div id="deleteConfirmation" class="delete-confirmation">
    <div class="div-confirmation">
        <p>Are you sure you want to delete this monnie?</p>
        <button class="btn btn-danger mt-3 me-2" id="confirmDelete" onclick="deleteMonnie()">Yes, Delete</button>
        <button class="btn btn-secondary mt-3 ms-2" id="cancelDelete" onclick="cancelDelete()">Cancel</button>
    </div>
</div>
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
{{-- End Div Confirmation --}}

<form id="formAjouterMonnie" action="{{ route('monnies.store') }}" method="POST">
    @csrf
    <h4 class="card-title mb-3 text-center">Ajouter Monnie</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" name="nom_monnie" class="form-control" id="tb-nmonnie" placeholder="Enter nom monnie">
                <label for="tb-ref">Nom Monnie</label>
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

    const ajouterMonnie = document.getElementById('ajouterMonnie');
    const annuler = document.getElementById('annuler');
    const formAjouterMonnie = document.getElementById('formAjouterMonnie');

    ajouterMonnie.addEventListener('click', () => {
        formAjouterMonnie.classList.add('showForm')
    })
    annuler.addEventListener('click', () => {
        formAjouterMonnie.classList.remove('showForm')
    })
    formAjouterMonnie.addEventListener('submit', function (event) {
        event.preventDefault();
        if (dataValid()) {
            this.submit();
        }
    })
    function dataValid() {
        const nomMonnie = document.getElementById('tb-nmonnie');
        nomMonnie.classList.remove('is-invalid');
        if (!nomMonnie.value) {
            nomMonnie.classList.add('is-invalid');
            return false;
        }
        return true;
    }

    let idMonnie = null;
    
    function deleteConfirmation(id) {
        idMonnie = id;
        document.getElementById('deleteConfirmation').classList.add('showConfirm');
    }

    function cancelDelete() {
        document.getElementById('deleteConfirmation').classList.remove('showConfirm');
    }

    function deleteMonnie() {
        const deleteForm = document.getElementById('deleteForm');
        if(idMonnie != null){
            deleteForm.action = '/admin/monnies/' + idMonnie;
            deleteForm.submit();
        }
    }
</script>

@endsection
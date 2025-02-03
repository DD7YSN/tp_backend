@extends('layouts.master')

@section('title', 'Admin | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBarAdmin')

    <div class="main pb-5">
        @include('layouts.nav')

        <div class="card right-side mx-lg-3 mt-5 p-3">

            <form id="formAjouterZone" action="{{ route('zones.update', $zone->id) }}" method="POST">
                @method('PUT')
                @csrf
                <h4 class="card-title mb-5 text-center">Modifier Zone</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom_zone" value="{{old('nom_zone', $zone->nom_zone)}}"
                                class="form-control" id="tb-nzone" placeholder="Enter nom zone">
                            <label for="tb-ref">Nom Zone</label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-md-flex align-items-center">
                            <div class="d-flex gap-6 ms-auto mt-3 mt-md-0">
                                <a href="{{route('zones.index')}}" type="reset"
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
@endsection
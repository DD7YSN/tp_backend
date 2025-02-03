@extends('layouts.master')

@section('title', 'Client | Livraison')

@section('content')
<div class="home">
    @include('layouts.sideBar')
    <div class="main pb-5">
        @include('layouts.nav')
        <div class="card card-body mx-lg-3 mt-4 py-4">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Account Setting</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Account Setting
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="card right-side mx-lg-3 mt-4">


            <div class="card">
                <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button"
                            role="tab" aria-controls="pills-account" aria-selected="true">
                            <!-- icon for mobile -->
                            <span class="d-none d-md-block">Account</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications"
                            type="button" role="tab" aria-controls="pills-notifications" aria-selected="false"
                            tabindex="-1">
                            <!-- icon for mobile -->
                            <span class="d-none d-md-block">Notifications</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button"
                            role="tab" aria-controls="pills-bills" aria-selected="false" tabindex="-1">
                            <!-- icon for mobile -->
                            <span class="d-none d-md-block">Bills</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button"
                            role="tab" aria-controls="pills-security" aria-selected="false" tabindex="-1">
                            <!-- icon for mobile -->
                            <span class="d-none d-md-block">Security</span>
                        </button>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-account" role="tabpanel"
                            aria-labelledby="pills-account-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Change Profile</h4>
                                            <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                            <div class="text-center">
                                                <img id="profileImage" src={{$utilisateur->img ?? "https://fakeimg.pl/250x250/"}} alt="{{$utilisateur->nom}}"
                                                    class="img-fluid rounded-circle" width="120" height="120">
                                                <div
                                                    class="d-flex align-items-center justify-content-center my-4 gap-6">
                                                    <input type="file" id="imageUpload" accept="image/*" class="d-none"
                                                        onchange="previewImage(event)">
                                                    <button class="btn btn-primary"
                                                        onclick="document.getElementById('imageUpload').click()">Upload</button>
                                                    <button class="btn bg-danger-subtle text-danger"
                                                        onclick="resetImage()">Reset</button>
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Change Password</h4>
                                            <p class="card-subtitle mb-4">To change your password please confirm
                                                here</p>
                                            <form>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Current
                                                        Password</label>
                                                    <input type="password" class="form-control"
                                                        id="exampleInputPassword1" value="12345678910">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword2" class="form-label">New
                                                        Password</label>
                                                    <input type="password" class="form-control"
                                                        id="exampleInputPassword2" value="12345678910">
                                                </div>
                                                <div>
                                                    <label for="exampleInputPassword3" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password" class="form-control"
                                                        id="exampleInputPassword3" value="12345678910">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card w-100 border position-relative overflow-hidden mb-0">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Personal Details</h4>
                                            <p class="card-subtitle mb-4">To change your personal detail , edit and
                                                save
                                                from here</p>
                                            <form id="userForm">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="nom" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="nom" name="nom"
                                                                value="{{$utilisateur->nom}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Ville</label>
                                                            <select class="form-select" name="ville" id="ville"
                                                                aria-label="Default select example">
                                                                <option selected="" value="">Select ville ...</option>
                                                                @foreach ($villes as $v)
                                                                    <option
                                                                        value="{{$v->id}} {{ $v->id == $utilisateur->local ? 'selected' : '' }}">
                                                                        {{$v->nom_ville}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{$utilisateur->email ?? ''}}"
                                                                placeholder="info@modernize.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="nomMagasin" class="form-label">Nom
                                                                magasin</label>
                                                            <input type="text" class="form-control" id="nomMagasin"
                                                                name="nom_magasin" placeholder="Nom magasin"
                                                                value="{{$utilisateur->nom_magasin ?? ''}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Devise</label>
                                                            <select class="form-select" id="id_banque" name="id_banque"
                                                                aria-label="Default select example">
                                                                <option selected="" value="">Select Devise ...</option>
                                                                @foreach ($monnies as $m)
                                                                    <option
                                                                        value="{{$m->id}} {{ $m->id == $utilisateur->id_banque ? 'selected' : '' }}">
                                                                        {{$m->nom_monnie}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tele" class="form-label">Telephone</label>
                                                            <input type="text" class="form-control" id="tele"
                                                                name="telephone"
                                                                value="{{$utilisateur->telephone ?? '' }}"
                                                                placeholder="+212 60000000" 0>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div>
                                                            <label for="adresse" class="form-label">Adresse</label>
                                                            <input type="text" class="form-control" id="adresse"
                                                                value="{{$utilisateur->nom_magasin ?? ''}}"
                                                                placeholder="814 Howard Street, 120065, India">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div
                                                            class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                            <button class="btn btn-primary">Save</button>
                                                            <button
                                                                class="btn bg-danger-subtle text-danger">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-notifications" role="tabpanel"
                            aria-labelledby="pills-notifications-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Notification Preferences</h4>
                                            <p class="card-subtitle mb-4">
                                                Select the notificaitons ou would like to receive via email. Please
                                                note
                                                that you cannot opt
                                                out of receving service
                                                messages, such as payment, security or legal notifications.
                                            </p>
                                            <form class="mb-7">
                                                <label for="exampleInputtext5" class="form-label">Email
                                                    Address*</label>
                                                <input type="text" class="form-control" id="exampleInputtext5"
                                                    placeholder="" required="">
                                                <p class="mb-0">Required for notificaitons.</p>
                                            </form>
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-article text-dark d-block fs-7" width="22"
                                                                height="22"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-4 fw-semibold">Our newsletter</h5>
                                                            <p class="mb-0">We'll always let you know about
                                                                important
                                                                changes</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mb-0">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-checkbox text-dark d-block fs-7" width="22"
                                                                height="22"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-4 fw-semibold">Order Confirmation</h5>
                                                            <p class="mb-0">You will be notified when customer order
                                                                any
                                                                product</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mb-0">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked1" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-clock-hour-4 text-dark d-block fs-7"
                                                                width="22" height="22"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-4 fw-semibold">Order Status Changed</h5>
                                                            <p class="mb-0">You will be notified when customer make
                                                                changes
                                                                to the order</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mb-0">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked2" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-truck-delivery text-dark d-block fs-7"
                                                                width="22" height="22"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-4 fw-semibold">Order Delivered</h5>
                                                            <p class="mb-0">You will be notified once the order is
                                                                delivered
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mb-0">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked3">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-mail text-dark d-block fs-7" width="22"
                                                                height="22"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-4 fw-semibold">Email Notification</h5>
                                                            <p class="mb-0">Turn on email notificaiton to get
                                                                updates
                                                                through email</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch mb-0">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked4" checked="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Date &amp; Time</h4>
                                            <p class="card-subtitle">Time zones and calendar display settings.</p>
                                            <div class="d-flex align-items-center justify-content-between mt-7">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22"
                                                            height="22"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Time zone</p>
                                                        <h5 class="fs-4 fw-semibold">(UTC + 02:00) Athens, Bucharet
                                                        </h5>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Download">
                                                    <i class="ti ti-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Ignore Tracking</h4>
                                            <div class="d-flex align-items-center justify-content-between mt-7">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-player-pause text-dark d-block fs-7" width="22"
                                                            height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Ignore Browser Tracking</h5>
                                                        <p class="mb-0">Browser Cookie</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end gap-6">
                                        <button class="btn btn-primary">Save</button>
                                        <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab"
                            tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title mb-3">Billing Information</h4>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext6" class="form-label">Business
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext6" placeholder="Visitor Analytics">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext7" class="form-label">Business
                                                                Address*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext7" placeholder="">
                                                        </div>
                                                        <div>
                                                            <label for="exampleInputtext8" class="form-label">First
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext8" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext9" class="form-label">Business
                                                                Sector*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext9"
                                                                placeholder="Arts, Media &amp; Entertainment">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext10"
                                                                class="form-label">Country*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext10" placeholder="Romania">
                                                        </div>
                                                        <div>
                                                            <label for="exampleInputtext11" class="form-label">Last
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputtext11" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Current Plan : <span
                                                    class="text-success">Executive</span>
                                            </h4>
                                            <p class="card-subtitle">Thanks for being a premium member and
                                                supporting our
                                                development.</p>
                                            <div class="d-flex align-items-center justify-content-between mt-7 mb-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-package text-dark d-block fs-7" width="22"
                                                            height="22"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Current Plan</p>
                                                        <h5 class="fs-4 fw-semibold">750.000 Monthly Visits</h5>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Add">
                                                    <i class="ti ti-circle-plus"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-primary">Change Plan</button>
                                                <button class="btn bg-danger-subtle text-danger">Reset Plan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Payment Method</h4>
                                            <p class="card-subtitle">On 26 December, 2023</p>
                                            <div class="d-flex align-items-center justify-content-between mt-7">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-credit-card text-dark d-block fs-7" width="22"
                                                            height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Visa</h5>
                                                        <p class="mb-0 text-dark">*****2102</p>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit">
                                                    <i class="ti ti-pencil-minus"></i>
                                                </a>
                                            </div>
                                            <p class="my-2">If you updated your payment method, it will only be
                                                dislpayed
                                                here after your
                                                next billing cycle.</p>
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn bg-danger-subtle text-danger">Cancel
                                                    Subscription</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end gap-6">
                                        <button class="btn btn-primary">Save</button>
                                        <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-security" role="tabpanel"
                            aria-labelledby="pills-security-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                            <div class="d-flex align-items-center justify-content-between pb-7">
                                                <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet
                                                    consectetur
                                                    adipisicing elit. Corporis sapiente
                                                    sunt earum officiis laboriosam ut.</p>
                                                <button class="btn btn-primary">Enable</button>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                                    <p class="mb-0">Google auth app</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                                    <p class="mb-0">E-mail to send verification link</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                                    <p class="mb-0">Your phone number or something</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div
                                                class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="ti ti-device-laptop text-primary d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <h4 class="card-title mb-0">Devices</h4>
                                            <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit
                                                Rem.</p>
                                            <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                            <div
                                                class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="ti ti-device-mobile text-dark d-block fs-7" width="26"
                                                        height="26"></i>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                                        <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="ti ti-device-laptop text-dark d-block fs-7" width="26"
                                                        height="26"></i>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                                        <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help
                                                ?</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end gap-6">
                                        <button class="btn btn-primary">Save</button>
                                        <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Function to preview the uploaded image

    const imageUpload = document.getElementById('imageUpload');
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageElement = document.getElementById('profileImage');
                imageElement.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
    function resetImage() {
        document.getElementById('profileImage').src = "https://fakeimg.pl/250x250/";
        document.getElementById('imageUpload').value = "";
    }


    // Get the form with inputs ::::
    const userForm = document.getElementById('userForm');
    const nom = document.getElementById('nom');
    const email = document.getElementById('email');
    const ville = document.getElementById('ville');
    const telephone = document.getElementById('tele');
    const nomMagasin = document.getElementById('nomMagasin');
    const id_banque = document.getElementById('id_banque');
    const adresse = document.getElementById('adresse');

    userForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const phonePattern = /^\+212\d{9}$/;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        const errorMessages = document.querySelectorAll(".form-control-feedback");
        errorMessages.forEach(msg => msg.remove());

        let valid = true;

        if (!nom.value.trim()) {
            showError("nom", "Nom is required");
            valid = false;
        }

        if (!ville.value) {
            showError("ville", "Please select a Ville");
            valid = false;
        }

        if (!email.value.trim() || !emailPattern.test(email.value)) {
            showError("email", "Please enter a valid email address");
            valid = false;
        }
        if (!telephone.value.trim() || !phonePattern.test(telephone.value)) {
            showError("tele", "Please enter a valid phone number");
            valid = false;
        }

        if (!nomMagasin.value.trim()) {
            showError("nomMagasin", "Nom Magasin is required");
            valid = false;
        }

        if (!id_banque.value) {
            showError("id_banque", "Please select a Devise");
            valid = false;
        }

        if (!adresse.value.trim()) {
            showError("adresse", "Adresse is required");
            valid = false;
        }

        if (valid) {
            userForm.submit();
        }
    });
    function showError(inputId, message) {
        const inputField = document.getElementById(inputId);
        const errorSmall = document.createElement("small");
        errorSmall.classList.add("form-control-feedback", "text-danger");
        errorSmall.textContent = message;
        inputField.parentElement.appendChild(errorSmall);
    }
</script>

@endsection
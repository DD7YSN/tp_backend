<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Bon_ramassageController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GeneralConteroller;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ZoneController;
use App\Models\Produit;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckClientMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', CheckClientMiddleware::class])->group(function () {

    Route::prefix('client')->group(function () {

        Route::get('/{user}', [ClientController::class, 'index'])->where('user', '[0-9]+')->name('clients.index');
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');
        // Route::get('/client/{id}', [ClientController::class, 'show'])->name('clients.show');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('/update/{id}', [ClientController::class, 'update'])->name('clients.update');
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

        // Start Route Coli ::::::::::::::::::::::::::::::::
        Route::get('/client/colis', [ColiController::class, 'listeColis'])->name('colis.listeColis');
        Route::get('/client/colis/ramassage', [ColiController::class, 'colisAttenderRamassage'])->name('colis.colisAttenderRamassage');
        Route::get('/client/colis/NonExpedies', [ColiController::class, 'colisNonExpedies'])->name('colis.colisNonExpedies');
        Route::get('/client/colis/create', [ColiController::class, 'create'])->name('colis.create');
        Route::post('/client/colis', [ColiController::class, 'store'])->name('colis.store');
        Route::get('/client/colis/{id}', [ColiController::class, 'show'])->name('colis.show');
        Route::get('/client/colis/edit/{id}', [ColiController::class, 'edit'])->name('colis.edit');
        Route::put('/client/colis/update/{id}', [ColiController::class, 'update'])->name('colis.update');
        Route::delete('/client/colis/{id}', [ColiController::class, 'destroy'])->name('colis.destroy');
        // End Route Coli ::::::::::::::::::::::::::::::::

        /// Stock Link ::::::::::::::::::::::::::
        Route::get('/stock/liste', [ProduitController::class, 'index'])->name('clients.produit.index');
        Route::get('/stock/create', [ProduitController::class, 'create'])->name('clients.produit.create');
        // End Route Store ::::::::::::::::::::::::::::::::
        /// Business Link ::::::::::::::::::::::::::
        Route::get('/business/liste', [BusinessController::class, 'indexByClient'])->name('business.indexByClient');
        Route::get('/business/create', [BusinessController::class, 'create'])->name('business.create');
        Route::post('/business/liste', [BusinessController::class, 'store'])->name('business.store');
        // End Business Store ::::::::::::::::::::::::::::::::
        // Route Bon_Ramassage :::::::::::::::::
        Route::get('/bon/ramassage', [Bon_ramassageController::class, 'index'])->name('bon_ramassage.index');
        Route::get('/bon/ramassage/create', [Bon_ramassageController::class, 'create'])->name('bon_ramassage.create');
        Route::post('/bon/ramassage', [Bon_ramassageController::class, 'store'])->name('bon_ramassage.store');
        Route::delete('/bon/ramassage/{id}', [Bon_ramassageController::class, 'destroy'])->name('bon_ramassage.destroy');
    });
    // End Route Clients :::::::::::::::::::::::::::::::::
});
// Start MiddleWare admin
Route::middleware(['auth', CheckAdminMiddleware::class])->group(function () {
    Route::prefix('admin')->group(function () {
        /// utilisateur Link ::::::::::::::::::::::::::
        Route::get('/utilisateur', [UtilisateurController::class, 'index'])->name('utilisateur.index');
        Route::get('/utilisateur/attendeActivation', [UtilisateurController::class, 'attendeActivation'])->name('utilisateur.attendeActivation');
        Route::get('/utilisateur/create', [UtilisateurController::class, 'create'])->name('utilisateur.create');
        Route::post('/utilisateur', [UtilisateurController::class, 'store'])->name('utilisateur.store');
        Route::post('/utilisateur/deactivate/{id}', [UtilisateurController::class, 'deactivateAccount'])->name('utilisateur.deactivateAccount');
        Route::post('/utilisateur/activeAccount/{id}', [UtilisateurController::class, 'activeAccount'])->name('utilisateur.activeAccount');
        Route::post('/utilisateur/accepteAccount/{id}', [UtilisateurController::class, 'accepteAccount'])->name('utilisateur.accepteAccount');
        Route::post('/utilisateur/refuseAccount/{id}', [UtilisateurController::class, 'refuseAccount'])->name('utilisateur.refuseAccount');
        Route::get('/utilisateur/edit/{id}', [UtilisateurController::class, 'edit'])->name('utilisateur.edit');
        Route::get('/utilisateur/role/{id}', [UtilisateurController::class, 'role'])->name('utilisateur.role');
        Route::get('/utilisateur/update/{id}', [UtilisateurController::class, 'update'])->name('utilisateur.update');
        Route::delete('/utilisateur/{id}', [UtilisateurController::class, 'destroy'])->name('utilisateur.destroy');

        /// Stock Link ::::::::::::::::::::::::::
        Route::get('/stock', [ProduitController::class, 'index'])->name('produit.index');
        Route::get('/stock/create', [ProduitController::class, 'create'])->name('produit.create');
        Route::get('/stock/{id}', [ProduitController::class, 'inventory'])->name('produit.inventory');
        Route::get('/stock/edit/{id}', [ProduitController::class, 'edit'])->name('produit.edit');
        Route::delete('/stock/{id}', [ProduitController::class, 'destroy'])->name('produit.destroy');



        /// Parameters Link ::::::::::::::::::::::::::
        // Start Route Ville ::::::::::::::::::::::::::::::::
        Route::get('/villes', [VilleController::class, 'index'])->name('villes.index');
        Route::get('/villes/{id}', [VilleController::class, 'show'])->name('villes.show');
        Route::post('/villes', [VilleController::class, 'store'])->name('villes.store');
        Route::get('/villes/edit/{id}', [VilleController::class, 'edit'])->name('villes.edit');
        Route::put('/villes/update/{id}', [VilleController::class, 'update'])->name('villes.update');
        Route::delete('/villes/{id}', [VilleController::class, 'destroy'])->name('villes.destroy');
        // End Route Ville ::::::::::::::::::::::::::::::::

        // Start Route Zone ::::::::::::::::::::::::::::::::
        Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');
        Route::post('/zones', [ZoneController::class, 'store'])->name('zones.store');
        Route::get('/zones/edit/{id}', [ZoneController::class, 'edit'])->name('zones.edit');
        Route::put('/zones/update/{id}', [ZoneController::class, 'update'])->name('zones.update');
        Route::delete('/zones/{id}', [ZoneController::class, 'destroy'])->name('zones.destroy');
        // End Route Zone ::::::::::::::::::::::::::::::::

        // Start Route General ::::::::::::::::::::::::::::::::

        Route::get('/general', [GeneralConteroller::class, 'index'])->name('general.index');
        Route::put('/general/update/{id}', [GeneralConteroller::class, 'update'])->name('general.update');

        // Start Route General ::::::::::::::::::::::::::::::::
        // Start Route Admin ::::::::::::::::::::::::::::::::

        Route::get('/', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/{id}', [AdminController::class, 'show'])->name('admins.show');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/update/{id}', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');


        Route::get('/clients', [AdminController::class, 'showClients'])->name('admins.showClients');
        Route::get('/clients/t', [AdminController::class, 'test'])->name('admins.test');

    });
});
// End Route Admin ::::::::::::::::::::::::::::::::
Route::get('/villes/{id}', [VilleController::class, 'show'])->name('villes.show');

// Start Login ::::::::::::::::::::::::::::::::
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// End Login ::::::::::::::::::::::::::::::::

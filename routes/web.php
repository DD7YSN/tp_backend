<?php

use App\Models\Produit;
use App\Models\Bon_ramassage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColiController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BonEnvoiController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\GeneralConteroller;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BanqueController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckClientMiddleware;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\Bon_ramassageController;
use App\Http\Middleware\CheckModerateurMiddleware;
use App\Http\Controllers\BonDistributionController;
use App\Http\Controllers\DashboardClientController;

Route::middleware(['auth', CheckClientMiddleware::class])->group(function () {
    Route::prefix('client')->group(function () {
        
        Route::get('/dashboard', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/dashboard/topville', [DashboardClientController::class, 'getTopVilles'])->name('clients.getTopVilles');
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');
        // Route::get('/client/{id}', [ClientController::class, 'show'])->name('clients.show');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('/update/{id}', [ClientController::class, 'update'])->name('clients.update');
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

        // Start Route Coli ::::::::::::::::::::::::::::::::
        Route::get('/colis', [ColiController::class, 'listeColis'])->name('colis.listeColis');
        // Route::get('/colis/ramassage', [ColiController::class, 'colisAttenderRamassage'])->name('colis.colisAttenderRamassage');
        // Route::get('/colis/NonExpedies', [ColiController::class, 'colisNonExpedies'])->name('colis.colisNonExpedies');
        Route::get('/colis/create', [ColiController::class, 'create'])->name('colis.create');
        Route::get('/colis/{id}', [ColiController::class, 'show'])->name('colis.show');
        Route::get('/colis/edit/{id}', [ColiController::class, 'edit'])->name('colis.edit');
        Route::post('/colis', [ColiController::class, 'store'])->name('colis.store');
        Route::post('/colis/filter', [ColiController::class, 'colisByFilter'])->name('colis.listeColis.filter');
        Route::put('/colis/update/{id}', [ColiController::class, 'update'])->name('colis.update');
        Route::delete('/colis/{id}', [ColiController::class, 'destroy'])->name('colis.destroy');
        // End Route Coli-ticket ::::::::::::::::::::::::::::::::
        Route::get('/coli/{id}/ticket', [ColiController::class, 'ticketColi'])->where('id', '\d+')->name('coli.ticket');
        Route::get('/bonrammasage/{trackNumber}/tickets', [Bon_ramassageController::class, 'coliByBonramassage'])->where('trackNumber', '[A-Za-z0-9]+')->name('bonramassage.ticket.coli');
        // End Route Coli-ticket ::::::::::::::::::::::::::::::::
        // End Route Coli ::::::::::::::::::::::::::::::::

        /// Stock Link ::::::::::::::::::::::::::
        Route::get('/stock/liste', [ProduitController::class, 'index'])->name('clients.produit.index');
        Route::get('/stock/produits', [ProduitController::class, 'getProducts'])->name('clients.list.produit');
        Route::get('/stock/produits/business/{idBusiness}', [ProduitController::class, 'produitsByBusiness'])->name('clients.list.produitsByBusiness');
        Route::get('/stock/create', [ProduitController::class, 'create'])->name('clients.produit.create');
        Route::post('/stock', [ProduitController::class, 'store'])->name('clients.produit.store');
        Route::delete('/stock/{id}', [ProduitController::class, 'destroy'])->name('clients.produit.destroy');
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

        Route::get('/dashboard',function (){
            return view('admins.index');
        })->name('dashboard.admin');
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


        // Start Route Banque ::::::::::::::::::::::::::::::::
        Route::get('/banques', [BanqueController::class, 'index'])->name('banques.index');
        Route::get('/banques/edit/{id}', [BanqueController::class, 'edit'])->name('banques.edit');
        Route::post('/banques', [BanqueController::class, 'store'])->name('banques.store');
        Route::put('/banques/{id}', [BanqueController::class, 'update'])->name('banques.update');
        Route::delete('/banques/{id}', [BanqueController::class, 'destroy'])->name('banques.destroy');

        // End Route Banque ::::::::::::::::::::::::::::::::

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


// Start Route Mod ::::::::::::::::::::::::::::::::
Route::middleware(['auth', CheckModerateurMiddleware::class])->group(function () {

    Route::get('/moderateur/colis', [ColiController::class, 'colisZone'])->name('moderateur.colis');
    Route::get('/bonDistribution', [BonDistributionController::class, 'index'])->name('bonDistr.index');
    Route::get('/bonDistribution/create', [BonDistributionController::class, 'create'])->name('bonDistr.create');
    Route::post('/bonDistribution/create', [BonDistributionController::class, 'store'])->name('bonDistr.store');
    Route::get('/bonEnvoi', [BonEnvoiController::class, 'index'])->name('bonEnvoi.index');
    Route::get('/bonEnvoi', [BonEnvoiController::class, 'index'])->name('bonEnvoi.index');
    Route::get('/bonEnvoi-scan', [BonEnvoiController::class, 'showScanBonEnvoi'])->name('bonEnvoi.Scan');
    Route::post('/update-status', [BonEnvoiController::class, 'updateStatus'])->name('update.status');
    Route::post('/moderateu/bon-envoi-scan/update-status', [BonEnvoiController::class, 'updateColiStatus'])->name('bonEnv.updateColiStatus');
    
});



// End Route Mod ::::::::::::::::::::::::::::::::






Route::get('/villes/{id}', [VilleController::class, 'show'])->name('villes.show');

Route::get('/', [AuthController::class, 'showLoginForm']);
// Start Login ::::::::::::::::::::::::::::::::
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// End Login ::::::::::::::::::::::::::::::::

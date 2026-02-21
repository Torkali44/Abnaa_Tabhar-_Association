<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('beneficiaries', BeneficiaryController::class);
    
    Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');
    Route::get('/supporters/create', [SupporterController::class, 'create'])->name('supporters.create');
    Route::post('/supporters/org', [SupporterController::class, 'storeOrg'])->name('supporters.org.store');
    Route::post('/supporters/individual', [SupporterController::class, 'storeIndividual'])->name('supporters.individual.store');
    Route::put('/supporters/org/{org}', [SupporterController::class, 'updateOrg'])->name('supporters.org.update');
    Route::put('/supporters/individual/{individual}', [SupporterController::class, 'updateIndividual'])->name('supporters.individual.update');
    Route::delete('/supporters/org/{org}', [SupporterController::class, 'destroyOrg'])->name('supporters.org.destroy');
    Route::delete('/supporters/individual/{individual}', [SupporterController::class, 'destroyIndividual'])->name('supporters.individual.destroy');
    
    Route::resource('employees', EmployeeController::class);
    
    Route::post('/donations', [\App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');
    
});


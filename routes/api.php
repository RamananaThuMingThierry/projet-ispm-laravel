<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClassesController;
use App\Http\Controllers\API\EtudiantsController;
use App\Http\Controllers\API\FilieresController;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function(){

    Route::get('/checkingAuthenticated', function(){
        return response()->json([
             'message' => 'You are in',
            'status' => 200], 200);
    });

    // Classes
    Route::get('classes', [ClassesController::class, 'index']); // Afficher toutes les classes    
    Route::post('store-classes', [ClassesController::class, 'store']);   // Créer une Classe
    Route::get('edit-classes/{id}', [ClassesController::class, 'edit']); // Modifier la Clalsses
    Route::put('update-classes/{id}', [ClassesController::class, 'update']); // Modifier la Classes
    Route::delete('delete-classes/{id}', [ClassesController::class, 'destroy']); // Supprimer une Classe
    // Filières
    Route::get('filieres', [FilieresController::class, 'index']); // Afficher toutes les filières    
    Route::post('store-filieres', [FilieresController::class, 'store']);   // Créer une filière
    Route::get('edit-filieres/{id}', [FilieresController::class, 'edit']); // Modifier une filière
    Route::put('update-filieres/{id}', [FilieresController::class, 'update']); // Modifier une filière
    Route::delete('delete-filieres/{id}', [FilieresController::class, 'destroy']); // Supprimer une filière
    // Etudiants
    Route::get('etudiants', [EtudiantsController::class, 'index']); // Afficher toutes les étudiants    
    Route::post('store-etudiants', [EtudiantsController::class, 'store']);   // Créer un étudiant
    Route::get('edit-etudiants/{id}', [EtudiantsController::class, 'edit']); // Modifier un étudiant
    Route::put('update-etudiants/{id}', [EtudiantsController::class, 'update']); // Modifier un étudiant
    Route::delete('delete-etudiants/{id}', [EtudiantsController::class, 'destroy']); // Supprimer un étudiant

    
    // users
    Route::get('users', [UsersController::class, 'index']);   // Liste des utilisateurs
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);
});


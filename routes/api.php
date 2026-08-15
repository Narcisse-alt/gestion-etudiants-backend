<?php

use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;

Route::apiResource('etudiants', EtudiantController::class);

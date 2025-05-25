<?php

use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\Api\DepartementController;
use App\Http\Controllers\API\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\RelationTypeController;
use App\Http\Controllers\API\articleCategorieController;
use App\Http\Controllers\API\articleController;
use App\Http\Controllers\API\articlePartageController;
use App\Http\Controllers\API\articleTypeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;

Route::apiResource('regions', RegionController::class);
Route::apiResource('departements', DepartementController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('ressources', articleController::class);
Route::apiResource('article_types', articleTypeController::class);
Route::apiResource('article_categories', articleCategorieController::class);
Route::apiResource('relation_types', RelationTypeController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('commentaires', CommentaireController::class);
Route::apiResource('article_partages', articlePartageController::class);
Route::apiResource('roles', RoleController::class);

//Route liée à la connexion et à la gestion du compte.
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::put('/user/update', [UserController::class, 'updateSelf'])->middleware('auth:sanctum');
Route::put('/admin/users/{id}/toggle', [UserController::class, 'toggleActif'])->middleware('auth:sanctum');

<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PlaceController;
use App\Controllers\TourController;
use App\Kernel\App;

App::router()->get('/', [HomeController::class, 'index']);
App::router()->get('/place/{id}', [PlaceController::class, 'details']);

App::router()->get('/leader/{id}', [TourController::class, 'details']);
App::router()->post('/leader/{id}/comment', [TourController::class, 'storeComment']);
App::router()->post('/leader/{id}/reserve', [TourController::class, 'storeReserve']);

App::router()->get('/login', [AuthController::class, 'index']);
App::router()->post('/register', [AuthController::class, 'register']);
App::router()->post('/login', [AuthController::class, 'login']);
App::router()->get('/profile', [AuthController::class, 'profile']);
App::router()->get('/logout', [AuthController::class, 'logout']);

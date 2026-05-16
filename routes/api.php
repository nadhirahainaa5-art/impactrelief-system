<?php

use App\Http\Controllers\Api\CampaignApiController;
use App\Http\Controllers\Api\DonationSimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/campaigns', [CampaignApiController::class, 'index']);
Route::post('/donations/simulate', [DonationSimulationController::class, 'store']);

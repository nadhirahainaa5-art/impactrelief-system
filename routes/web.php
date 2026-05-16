<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FundAllocationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffManagementController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $campaigns = \App\Models\Campaign::whereIn('status', ['active', 'approved'])
        ->latest()
        ->take(6)
        ->get();

    return view('welcome', compact('campaigns'));
})->name('home');

Route::get('/donate', [PublicDonationController::class, 'create'])
    ->name('public-donations.create');

Route::post('/donate', [PublicDonationController::class, 'store'])
    ->name('public-donations.store');

Route::get('/donate/success/{donation}', [PublicDonationController::class, 'success'])
    ->name('public-donations.success');

/*
|--------------------------------------------------------------------------
| PUBLIC CERTIFICATE
|--------------------------------------------------------------------------
*/

Route::get('/donations/{donation}/certificate', [DonationController::class, 'certificate'])
    ->name('donations.certificate');

Route::get('/donate/catalog', [PublicDonationController::class, 'catalog'])
    ->name('public-donations.catalog');

Route::get('/donate/catalog/{campaign}', [PublicDonationController::class, 'show'])
    ->name('public-donations.show');

/*
|--------------------------------------------------------------------------
| Auth Required Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isStaff()) {
            return redirect()->route('staff.dashboard');
        }

        if ($user->isDonor()) {
            return redirect()->route('donor.dashboard');
        }

        abort(403);

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | Staff Management
        |--------------------------------------------------------------------------
        */
        Route::get('/staff', [StaffManagementController::class, 'index'])
            ->name('admin.staff.index');

        Route::get('/staff/create', [StaffManagementController::class, 'create'])
            ->name('admin.staff.create');

        Route::post('/staff', [StaffManagementController::class, 'store'])
            ->name('admin.staff.store');

        Route::patch('/staff/{user}/toggle-status', [StaffManagementController::class, 'toggleStatus'])
            ->name('admin.staff.toggle-status');

        Route::post('/campaigns/{campaign}/approve', [CampaignController::class, 'approve'])
            ->name('campaigns.approve');

        Route::post('/campaigns/{campaign}/reject', [CampaignController::class, 'reject'])
            ->name('campaigns.reject');

        Route::post('/campaigns/{campaign}/review', [CampaignController::class, 'review'])
            ->name('campaigns.review');

        Route::post('/allocations/{fundAllocation}/approve', [FundAllocationController::class, 'approve'])
            ->name('fund-allocations.approve');

        Route::post('/allocations/{fundAllocation}/reject', [FundAllocationController::class, 'reject'])
            ->name('fund-allocations.reject');

        Route::post('/allocations/{fundAllocation}/review', [FundAllocationController::class, 'review'])
            ->name('fund-allocations.review');

        Route::post('/expenses/{expense}/approve', [ExpenseController::class, 'approve'])
            ->name('expenses.approve');

        Route::post('/expenses/{expense}/reject', [ExpenseController::class, 'reject'])
            ->name('expenses.reject');

        Route::post('/expenses/{expense}/review', [ExpenseController::class, 'review'])
            ->name('expenses.review');
    });

    /*
    |--------------------------------------------------------------------------
    | Staff
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:staff'])->prefix('staff')->group(function () {

        Route::get('/dashboard', [StaffController::class, 'dashboard'])
            ->name('staff.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Donor
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:donor'])->prefix('donor')->group(function () {

        Route::get('/dashboard', [DonorController::class, 'dashboard'])
            ->name('donor.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Main Resources
    |--------------------------------------------------------------------------
    */
    Route::resource('campaigns', CampaignController::class);
    Route::resource('fund-allocations', FundAllocationController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('donations', DonationController::class);

    Route::get('/donations/{donation}/receipt', [DonationController::class, 'receipt'])
        ->name('donations.receipt');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

Route::get('/test-route', function () {
    return 'Laravel Routes Working';
});
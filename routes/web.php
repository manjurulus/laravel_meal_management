<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BillController,
    DevController,
    DeveloperController,
    ExpenseController,
    ManagerController,
    MealController,
    PaymentController,
    ReportController
};

// Public route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authenticated dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Include additional route files
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Developer routes
Route::prefix('dev')->controller(DeveloperController::class)->group(function () {
    Route::get('/', 'index')->name('dev.index');
    Route::get('/create', 'create')->name('dev.create');
    Route::get('/{id}', 'show')->name('dev.show');
    Route::get('/{id}/edit', 'edit')->name('dev.edit');
    Route::post('/', 'store')->name('dev.store');
    Route::delete('/{id}', 'destroy')->name('dev.destroy');
});

// Meal Management routes
Route::middleware(['auth'])->group(function () {

    // Member routes
    Route::middleware('check.role:member')->group(function () {
        Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
        Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/dues', [BillController::class, 'memberDues'])->name('dues.index');
    });

    // Manager routes
    Route::middleware('check.role:manager')->group(function () {
        Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
        Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
        Route::post('/bills/{bill}/assign', [BillController::class, 'assignToUser'])->name('bills.assign');

        Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
        Route::get('/manager/users', [ManagerController::class, 'index'])->name('manager.users.index');
        Route::get('/manager/users/create', [ManagerController::class, 'createUser'])->name('manager.users.create');
        Route::post('/manager/users/store', [ManagerController::class, 'storeUser'])->name('manager.users.store');
        Route::get('/manager/reports', [ReportController::class, 'index'])->name('manager.reports.index');
        Route::get('/manager/members/search', [ManagerController::class, 'searchMembers'])->name('manager.members.search');
    });

    // Accountant routes
    Route::middleware('check.role:accountant')->group(function () {
        Route::get('/accountant/payments', [PaymentController::class, 'receive'])->name('accountant.payments.receive');

        // ✅ Primary monthly report route
        Route::get('/accountant/reports/monthly/{month?}', [ReportController::class, 'monthly'])->name('accountant.reports.monthly');

        // ✅ Optional fallback route to fix RouteNotFoundException
        Route::get('/accountant/reports/monthly', function () {
            return redirect()->route('accountant.reports.monthly', ['month' => now()->month]);
        })->name('reports.monthly');
    });

    // Operations routes
    Route::middleware('check.role:operations')->group(function () {
        Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
    });
});

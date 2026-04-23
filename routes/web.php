<?php

use App\Http\Controllers\ActivityPurposeController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DocumentHistoryController;
use App\Http\Controllers\FacilityRequestController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SummaryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'dashboard' : 'login');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [CalendarController::class, 'index'])->name('dashboard');
    Route::get('calendar/events', [CalendarController::class, 'events'])->name('calendar.events');

    Route::get('requests', [FacilityRequestController::class, 'index'])->name('requests.index');
    Route::get('requests/create', [FacilityRequestController::class, 'create'])->name('requests.create');
    Route::post('requests', [FacilityRequestController::class, 'store'])->name('requests.store');
    Route::get('requests/{facilityRequest}', [FacilityRequestController::class, 'show'])->name('requests.show');

    Route::middleware('permission:request.approve')->group(function () {
        Route::get('approvals', [ApprovalController::class, 'index'])->name('approvals.index');
        Route::patch('requests/{facilityRequest}/status', [ApprovalController::class, 'update'])->name('approvals.update');
        Route::get('document-history', [DocumentHistoryController::class, 'index'])->name('document-history.index');
        Route::get('summary', [SummaryController::class, 'index'])->name('summary.index');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('activity-purposes', [ActivityPurposeController::class, 'index'])->name('activity-purposes.index');
        Route::post('activity-purposes', [ActivityPurposeController::class, 'store'])->name('activity-purposes.store');
        Route::patch('activity-purposes/{activityPurpose}', [ActivityPurposeController::class, 'update'])->name('activity-purposes.update');
        Route::delete('activity-purposes/{activityPurpose}', [ActivityPurposeController::class, 'destroy'])->name('activity-purposes.destroy');
        Route::get('log', [LogController::class, 'index'])->name('log.index');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

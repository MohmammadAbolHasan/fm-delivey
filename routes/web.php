<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SettingsController;

Route::redirect('/', '/dashboard');




Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::patch('/invoices/{invoice}/status/{status}', [InvoiceController::class, 'changeStatus'])
        ->name('invoices.changeStatus');

        Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])
    ->name('invoices.pdf');

    // الـ Routes المخصصة للفواتير يجب أن تكون قبل الـ resource لتجنب التعارض
    Route::get('/invoices/status/pending', [InvoiceController::class, 'pending'])
        ->name('invoices.pending');
    Route::get('/invoices/status/done', [InvoiceController::class, 'done'])
        ->name('invoices.done');
    Route::get('/invoices/status/rejected', [InvoiceController::class, 'rejected'])
        ->name('invoices.rejected');
    Route::get('/invoices/status/delayed', [InvoiceController::class, 'delayed'])
        ->name('invoices.delayed');

    Route::resource('clients', ClientController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('invoices', InvoiceController::class);

    // مسار التقارير المرتبط بالكنترولر حصراً لإرسال المتغيرات بشكل صحيح
    Route::get('/reports', [DashboardController::class, 'reports'])
        ->name('reports.index');
Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch');
        
Route::get('/settings', [SettingsController::class, 'index'])
    ->name('settings');

Route::post('/settings', [SettingsController::class, 'update'])
    ->name('settings.update');
});

require __DIR__.'/auth.php';

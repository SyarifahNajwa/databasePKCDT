<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PenomoranFormController;
use App\Models\Penomoran;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grup Route yang wajib Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        $penomorans = Penomoran::with([
            'pengirim',
            'penerima',
            'pemberitahu',
            'suratIzin',
            'pengangkutan',
            'pib',
            'uraianBarangs',
            'pfpd',
            'pemeriksa',
            'jaminan',
            'pemeriksaan',
        ])->orderByDesc('created_at')->get();

        $totalPenomorans = $penomorans->count();
        $completedPenomorans = $penomorans->where('progress_percentage', 100)->count();
        $averageProgress = $totalPenomorans ? round($penomorans->avg('progress_percentage')) : 0;

        return view('dashboard', compact('penomorans', 'totalPenomorans', 'completedPenomorans', 'averageProgress'));
    })->name('dashboard');

    // Penomoran Form - Multi Step
    Route::prefix('penomoran-form')->name('penomoran-form.')->group(function () {
        // List
        Route::get('/', [PenomoranFormController::class, 'list'])->name('list');
        
        // Create Page 1
        Route::get('/create', [PenomoranFormController::class, 'page1'])->name('create');
        
        // Pages
        Route::get('/{id}/page1', [PenomoranFormController::class, 'page1'])->name('edit');
        Route::get('/{id}/page2', [PenomoranFormController::class, 'page2'])->name('page2');
        Route::get('/{id}/page3', [PenomoranFormController::class, 'page3'])->name('page3');
        Route::get('/{id}/page4', [PenomoranFormController::class, 'page4'])->name('page4');
        Route::get('/{id}/page5', [PenomoranFormController::class, 'page5'])->name('page5');
        Route::get('/{id}/page6', [PenomoranFormController::class, 'page6'])->name('page6');
        Route::get('/{id}/page7', [PenomoranFormController::class, 'page7'])->name('page7');
        Route::get('/{id}/page8', [PenomoranFormController::class, 'page8'])->name('page8');
        Route::get('/{id}/page9', [PenomoranFormController::class, 'page9'])->name('page9');
        
        // Save Pages
        Route::post('/save-page1', [PenomoranFormController::class, 'savePage1'])->name('savePage1');
        Route::post('/{id}/save-page2', [PenomoranFormController::class, 'savePage2'])->name('savePage2');
        Route::post('/{id}/save-page3', [PenomoranFormController::class, 'savePage3'])->name('savePage3');
        Route::post('/{id}/save-page4', [PenomoranFormController::class, 'savePage4'])->name('savePage4');
        Route::post('/{id}/save-page5', [PenomoranFormController::class, 'savePage5'])->name('savePage5');
        Route::post('/{id}/save-page6', [PenomoranFormController::class, 'savePage6'])->name('savePage6');
        Route::post('/{id}/save-page7', [PenomoranFormController::class, 'savePage7'])->name('savePage7');
        Route::post('/{id}/save-page8', [PenomoranFormController::class, 'savePage8'])->name('savePage8');
        Route::post('/{id}/save-page9', [PenomoranFormController::class, 'savePage9'])->name('savePage9');
        
        // Show/Read
        Route::get('/{id}', [PenomoranFormController::class, 'show'])->name('show');
        
        // Print
        Route::get('/{id}/print', [PenomoranFormController::class, 'print'])->name('print');
        Route::get('/{id}/print-ip', [PenomoranFormController::class, 'printIp'])->name('printIp');
        Route::get('/{id}/print-sppb', [PenomoranFormController::class, 'printSppb'])->name('printSppb');
        Route::get('/{id}/print-lhp-ip', [PenomoranFormController::class, 'printLhpIp'])->name('printLhpIp');
        
        // Delete
        Route::delete('/{id}', [PenomoranFormController::class, 'destroy'])->name('destroy');
        
        // Back
        Route::get('/{id}/back/{page}', [PenomoranFormController::class, 'back'])->name('back');
    });

    // Petugas (Cetak diletakkan sebelum Resource)
    Route::get('petugas/{id}/cetak', [PetugasController::class, 'cetak'])->name('petugas.cetak');
    Route::resource('petugas', PetugasController::class);

    // Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin area (role: admin)
    Route::prefix('admin')->name('admin.')->middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });

    // Staff area (role: staff)
    Route::prefix('staff')->name('staff.')->middleware([\App\Http\Middleware\RoleMiddleware::class.':staff'])->group(function () {
        Route::get('/dashboard', function () {
            return view('staff.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
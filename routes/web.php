<?php

use App\Http\Controllers\MainPageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserInformationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::as('blogs.')->group(function(){
    Route::get('/', [MainPageController::class, 'index'])->name('index');

    Route::post('/search', [MainPageController::class, 'search'])->name('search');
    
    Route::get('/top-rated', [MainPageController::class, 'topRated'])->name('top-rated');
    
    Route::get('/{blog_id}/show', [MainPageController::class, 'show'])->name('show');
});

Route::middleware(['auth'])->group(function(){

    Route::group( [
        'as' => 'user.information.',
        'prefix' => 'user/information',
    ],function(){
        Route::get('/', [UserInformationController::class, 'index'])->name('index');
        Route::get('edit', [UserInformationController::class, 'edit'])->name('edit');
        Route::put('{userID}/edit', [UserInformationController::class, 'update'])->name('update');    
    });

    Route::post('/interaction/{blog}', [MainPageController::class, 'like'])->name('blogs.interaction');
    
    Route::post('/postComment/{blog}', [MainPageController::class, 'newComment'])->name('blogs.comment');
        
    Route::get('dashboard/trash', [DashboardController::class, 'trash'])->name('dashboard.trash');

    Route::put('dahsboard/{id}/restore', [DashboardController::class, 'restore'])->name('dashboard.restore');

    Route::resource('dashboard', DashboardController::class);
});

// Route::get('/dashboard', [DashboardController::class, 'index'])
//             ->middleware(['auth'])->name('dashboard.index');

require __DIR__.'/auth.php';

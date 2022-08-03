<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\getData;
use App\Http\Controllers\putData;

Route::middleware([Seedr::class,])->group(function () {
        Route::get('/', [getData::class, 'viewHome'])->name('home');
        Route::view('/signin', 'signin')->name('signin');
        Route::get('/tag/{filter?}', [getData::class, 'viewFilter'])->name('tags');
        Route::get('/place/{filter?}', [getData::class, 'viewFilter'])->name('loca');
        Route::get('/language/{filter?}', [getData::class, 'viewFilter'])->name('language');
        Route::get('/category/{filter?}', [getData::class, 'viewFilter'])->name('category');
        Route::get('/year/{filter?}', [getData::class, 'viewFilter'])->name('year');
        Route::get('/trending', [getData::class, 'viewTrending'])->name('trending');
        Route::get('/recent', [getData::class, 'viewRecent'])->name('recent');
});

Route::get('/polls/{id?}', [getData::class, 'viewPoll'])
        ->name('poll')
        ->middleware('PollView');
Route::post('/vote/{id}', [putData::class, 'putVote'])
        ->name('vote');
Route::post('/signin', [putData::class, 'signIn'])
        ->name('signin');
Route::post('/add', [putData::class, 'addPoll'])
        ->name('add');
Route::get('/profile/{id?}', [getData::class, 'viewProfile'])
        ->name('profile');
Route::get('/opinion/{id}', [getData::class, 'viewProfile'])
        ->name('opinion');
Route::get('/getpoll/{id}/comments', [getData::class, 'viewCom'])
        ->name('comments');
Route::get('getpoll/{id}/options', [getData::class, 'viewOpt'])
        ->name('options');
Route::post('/follow', [putData::class, 'followUser'])
        ->name('follow');

Route::post('/viewFoll/{id}', function ($id = null) {
        return view('layout.viewFoll', ['id' => $id]);
})->name('viewFoll');

Route::get("/menu", function () {
        return view("menu");
})->name('menu');

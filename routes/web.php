<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/event-list', [EventController::class, 'index'])->middleware(['auth', 'verified'])->name('eventlist');
Route::middleware('auth')->group(function () {
    Route::get('/event-list/search', [EventController::class, 'search'])->name('eventlist.search');
    Route::get('/event-list/sort-asc', [EventController::class, 'sortAsc'])->name('eventlist.sortasc');
    Route::get('/event-list/sort-desc', [EventController::class, 'sortDesc'])->name('eventlist.sortdesc');
    Route::get('/event-list/retrieve-deployed', [EventController::class, 'retrieveDeployedAdmin'])->name('eventlist.retrievedeployed');
    Route::get('/event-list/create', [EventController::class, 'create'])->name('eventlist.create');
    Route::get('/event-list/{id}', [EventController::class, 'showDetails'])->name('eventlist.showdetails');
    Route::get('/event-list/edit/{id}', [EventController::class, 'edit'])->name('eventlist.edit');
    Route::post('/event-list/store', [EventController::class, 'store'])->name('eventlist.store');
    Route::put('/event-list/update/{id}', [EventController::class, 'update'])->name('eventlist.update');
    Route::delete('/event-list/destroy/{id}', [EventController::class, 'destroy'])->name('eventlist.destroy');
    Route::put('/event-list/deploy/{id}', [EventController::class, 'deploy'])->name('eventlist.deploy');
    Route::post('/event-list/create-seats/{id}', [EventController::class,'createSeats'])->name('eventlist.createseats');
    Route::get('/event-list/{id}/seat/{seat_id}', [EventController::class, 'seatDetails'])->name('eventlist.seatdetails');
});

Route::get('buyer-list', [BuyerController::class, 'index'])->middleware(['auth', 'verified'])->name('buyerlist');
Route::middleware('auth')->group(function () {
    Route::get('/buyer-list/search', [BuyerController::class, 'search'])->name('buyerlist.search');
    Route::get('/buyer-list/sort-asc', [BuyerController::class, 'sortAsc'])->name('buyerlist.sortasc');
    Route::get('/buyer-list/sort-desc', [BuyerController::class, 'sortDesc'])->name('buyerlist.sortdesc');
    Route::get('/buyer-list/edit/{id}', [BuyerController::class, 'edit'])->name('buyerlist.edit');
    Route::put('/buyer-list/update/{id}', [BuyerController::class, 'update'])->name('buyerlist.update');
    Route::delete('/buyer-list/destroy/{id}', [BuyerController::class, 'destroy'])->name('buyerlist.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('suggestion-list', [SuggestionController::class, 'index'])->name('suggestionlist');
    Route::get('suggestion-list/search', [SuggestionController::class, 'search'])->name('suggestionlist.search');
    Route::get('suggestion-list/sort-asc', [SuggestionController::class, 'sortAsc'])->name('suggestionlist.sortasc');
    Route::get('suggestion-list/sort-desc', [SuggestionController::class, 'sortDesc'])->name('suggestionlist.sortdesc');
    Route::get('suggestion-list/retrieve-pinned', [SuggestionController::class, 'retrievePinned'])->name('suggestionlist.retrievepinned');
    Route::get('suggestion-list/retrieve-checked', [SuggestionController::class, 'retrieveChecked'])->name('suggestionlist.retrievechecked');
    Route::get('suggestion-list/{id}', [SuggestionController::class, 'showDetails'])->name('suggestionlist.details');
    Route::post('suggestion-list/pin/{id}', [SuggestionController::class, 'pinSuggestion'])->name('suggestionlist.pin');
    Route::post('suggestion-list/check/{id}', [SuggestionController::class, 'checkSuggestion'])->name('suggestionlist.check');
    Route::post('suggestion-list/unpin/{id}', [SuggestionController::class, 'unpinSuggestion'])->name('suggestionlist.unpin');
    Route::post('suggestion-list/uncheck/{id}', [SuggestionController::class, 'uncheckSuggestion'])->name('suggestionlist.uncheck');
    Route::delete('suggestion-list/destroy/{id}', [SuggestionController::class, 'destroy'])->name('suggestionlist.destroy');
});

require __DIR__.'/auth.php';

Route::get('/index', function(){
    return view('index');
})->name('index');

Route::get('/event', [EventController::class, 'indexDeployed'])->name('event');
Route::get('/event/{id}', [EventController::class, 'showDetailsDeployed'])->name('event.showdeployed');
Route::get('/event/{id}/seat/{seat_id}', [EventController::class, 'seatDetailsDeployed'])->name('event.seatdetails');
Route::post('/event/{id}/seat/{seat_id}/buy', [EventController::class, 'buyTicket'])->name('event.buy');
Route::get('/event/{event_id}/seat/{seat_id}/confirmed', [EventController::class, 'showConfirmed'])->name('event.confirmed');

Route::get('/contact', [SuggestionController::class, 'contact'])->name('contact');
Route::post('/contact/send', [SuggestionController::class, 'store'])->name('contact.send');

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::get('/test', function(){ // test logged in
    echo 'test';
})->middleware(['auth', 'verified']);
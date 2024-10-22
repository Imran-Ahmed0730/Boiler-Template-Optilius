<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SupportTicketController;
use App\Http\Controllers\Frontend\UserMessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->group(base_path('routes/admin.php'));
Route::middleware('web')
    ->group(base_path('routes/customer.php'));


//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/support-ticket', 'support')->name('support');
    Route::get('/live-chat', 'chat')->name('chat');
    Route::get('/contact', 'contact')->name('contact');
});
Route::post('live/chat/message/send', [\App\Http\Controllers\Frontend\LiveChatController::class, 'store'])->name('live.chat.message.send');
Route::post('message/send', [UserMessageController::class, 'store'])->name('message.send');
Route::controller(SupportTicketController::class)->prefix('support')->name('support.')->group(function () {
    Route::post('submit', 'store')->name('submit');
    Route::get('chat', 'show')->name('chat');
    Route::get('chat/view/{token}', 'publicChat')->name('chat.public');
    Route::post('chat/message/send', 'publicUpdate')->name('chat.message.send');
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index']);





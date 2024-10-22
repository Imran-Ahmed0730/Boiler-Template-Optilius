<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\FrontendPageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SmsTemplateController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaticTranslationController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Frontend\LiveChatController;
use App\Http\Controllers\Frontend\SupportTicketController;
use App\Http\Controllers\Frontend\UserMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Auth\Middleware\Authorize;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('login');
    Route::middleware('admin')->group(function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit', [DashboardController::class, 'profileEdit'])->name('edit');
            Route::post('/update', [DashboardController::class, 'profileUpdate'])->name('update');
        });
        Route::post('password/update', [DashboardController::class, 'passwordChange'])->name('password.update');

        //setting module
        Route::controller(SettingController::class)->prefix('setting')->name('setting.')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/list', 'index')->name('index');
            Route::get('/edit/{slug}', 'goToSection')->name('edit');
            Route::post('/language/remove', 'removeLanguage')->name('language.remove');
            Route::post('/update', 'update')->name('update');
        });

        //page module
        Route::resource('page', PageController::class);
        Route::controller(PageController::class)->prefix('page')->name('page.')->group(function () {
            Route::post('/update','update')->name('update');
            Route::post('/delete','destroy')->name('delete');
        });

        //sms-template module
        Route::resource('sms-template', SmsTemplateController::class);
        Route::controller(SmsTemplateController::class, )->prefix('sms-template')->name('sms-template.')->group(function () {
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'destroy')->name('delete');
        });

        //sms-template module
        Route::resource('email-template', EmailTemplateController::class);
        Route::controller(EmailTemplateController::class)->prefix('email-template')->name('email-template.')->group(function () {
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'destroy')->name('delete');
        });

        //subscriber module
        Route::prefix('subscriber')->name('subscriber.')->group(function () {
            Route::get('/index', [SubscriberController::class, 'index'])->name('index');
        });

        //role module
        Route::resource('role', RoleController::class);
        Route::controller(RoleController::class)->prefix('role')->name('role.')->group(function () {
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'destroy')->name('delete');
            Route::get('/accessibility/assign/{id}', 'assignPermission')->name('accessibility.assign');
            Route::post('/permission/assign', 'assignPermissionSubmit')->name('permission.assign.submit');
        });

        //permission module
        Route::resource('permission', PermissionController::class);
        Route::controller(PermissionController::class)->prefix('permission')->name('permission.')->group(function () {
            Route::post('/update',  'update')->name('update');
            Route::post('/delete',  'destroy')->name('delete');
        });

        //staff module
        Route::resource('staff', StaffController::class);
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::controller(StaffController::class)->group(function () {
                Route::post('/update','update')->name('update');
                Route::post('/delete','destroy')->name('delete');
            });
            Route::controller(DashboardController::class)->group(function () {
                Route::get('/role/assign', 'roleAssign')->name('assign');
                Route::post('/role/assign/submit', 'roleAssignSubmit')->name('role.assign.submit');
            });
        });

        //support ticket module
        Route::controller(SupportTicketController::class)->prefix('support')->name('support.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/close/{id}', 'close')->name('close');
            Route::get('/open/{id}', 'open')->name('open');
            Route::get('/chat/{id}', 'chat')->name('chat');
            Route::post('/chat/message/send', 'update')->name('chat.message.send');
            Route::post('/assign',  'assign')->name('assign');
        });

        //support ticket module
        Route::controller(LiveChatController::class)->prefix('live-chat')->name('live-chat.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/close/{id}', 'close')->name('close');
            Route::get('/open/{id}', 'open')->name('open');
            Route::get('/chat/{id}', 'chat')->name('chat');
            Route::post('/chat/message/send', 'store')->name('chat.message.send');
            Route::post('/assign',  'assign')->name('assign');
        });

        //message module
        Route::controller(UserMessageController::class)->prefix('message')->name('message.')->group(function () {
            Route::get('/',  'index')->name('index');
            Route::post('/delete','destroy')->name('delete');
        });

        //country module
        Route::resource('country', CountryController::class);
        Route::controller(CountryController::class)->prefix('country')->name('country.')->group(function () {
            Route::post('/update',  'update')->name('update');
            Route::post('/delete',  'destroy')->name('delete');
        });

        //frontend page module
        Route::resource('frontend-page', FrontendPageController::class);
        Route::controller(FrontendPageController::class)->prefix('frontend-page')->name('frontend-page.')->group(function () {
            Route::post('/update',  'update')->name('update');
            Route::post('/delete',  'destroy')->name('delete');
            Route::get('/translations/{id}',  'translation')->name('translations');
        });

        //static keyword translation module
        Route::resource('static-translation', StaticTranslationController::class);
        Route::controller(StaticTranslationController::class)->prefix('static-translation')->name('static-translation.')->group(function () {
            Route::post('/update',  'update')->name('update');
            Route::post('/delete',  'destroy')->name('delete');
        });

    });
});

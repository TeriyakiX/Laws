<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use Cyberbrains\Filemanager\Controllers\FileController;
use App\Http\Controllers\API\IntensionController;
use App\Http\Controllers\API\BeliefController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\GptController;
use App\Http\Controllers\Auth\GoogleController;
use \App\Http\Controllers\Auth\AppleController;
use \App\Http\Controllers\Auth\ForgotPasswordController;
use \App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\API\CheckListController;

use App\Notifications\PushNotification;


Route::prefix('v1')->group(function () {

    Route::controller(RegisterController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('send-reset-password-link', [ResetPasswordController::class, 'sendResetPasswordLink']);
        Route::post('reset-password/{token}', [ResetPasswordController::class, 'resetPassword']);

        Route::middleware('auth:sanctum')->group( function () {
            Route::post('logout', 'logout');
            Route::put('update-profile', 'updateProfile');
            Route::get('get-user', 'getUser');
            Route::delete('delete-account', 'deleteAccount');

            Route::get('/send-notification', function () {
                $user = auth()->user(); // Assuming you have a user model and authentication system
                $user->notify(new PushNotification());
                return "Notification sent!";
            });

        });

        Route::prefix('auth')->middleware('api')->group(function () {
            Route::get('google', [GoogleController::class, 'redirectToGoogle']);
            Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
            Route::get('apple', [AppleController::class, 'redirectToApple']);
            Route::get('apple/callback', [AppleController::class, 'handleAppleCallback']);
        });

        Route::middleware('auth:sanctum')->group( function () {
        Route::middleware('ban')->group( function () {
            // intension crud
            Route::get('intension/index', [IntensionController::class, 'index']);
            Route::post('intension/create', [IntensionController::class, 'create']);
            Route::put('intension/{id}/update', [IntensionController::class, 'update']);
            Route::delete('intension/{id}/delete', [IntensionController::class, 'delete']);


            // belief crud
            Route::get('belief/index', [BeliefController::class, 'index']);
            Route::post('belief/create', [BeliefController::class, 'create']);
            Route::put('belief/{id}/update', [BeliefController::class, 'update']);
            Route::delete('belief/{id}/delete', [BeliefController::class, 'delete']);

            // program crud
            Route::get('program/index', [ProgramController::class, 'index']);
            Route::post('program/create', [ProgramController::class, 'create']);
            Route::put('program/{id}/update', [ProgramController::class, 'update']);
            Route::delete('program/{id}/delete', [ProgramController::class, 'delete']);

            // currency crud
            Route::get('currency/index', [CurrencyController::class, 'index']);
            Route::post('currency/create', [CurrencyController::class, 'create']);
            Route::put('currency/{id}/update', [CurrencyController::class, 'update']);
            Route::delete('currency/{id}/delete', [CurrencyController::class, 'delete']);

            // bank crud
            Route::get('bank/index', [BankController::class, 'index']);
            Route::post('bank/create', [BankController::class, 'create']);
            Route::put('bank/{id}/update', [BankController::class, 'update']);
            Route::delete('bank/{id}/delete', [BankController::class, 'delete']);

            // check list
            Route::get('checklist/index', [CheckListController::class, 'index']);
            Route::post('checklist/create', [CheckListController::class, 'create']);
            Route::get('checklist/finished/{id}', [CheckListController::class, 'action']);
            Route::get('checklist/delete/{id}', [CheckListController::class, 'delete']);

            Route::post('chat/gpt', [GptController::class, 'chat']);
        });
        });


    });


});



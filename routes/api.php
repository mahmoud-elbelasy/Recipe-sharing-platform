<?php

use App\Http\Controllers\Api\CloudController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\FriendsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware'=> 'ForceJson'], function (){

    Route::post('/login',[ApiAuthController::class,'login'])->name('login.api');
    Route::post('/register',[RegisteredUserController::class,'register'])->name('register.api');

});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout',[ApiAuthController::class,'logout'])->name('logout.api');



});

Route::middleware('auth:api')->group(function () {
    Route::post('/friendRequest',[FriendsController::class,'friendRequest'])->name('friendRequest.api');
    Route::post('/acceptFriendRequest',[FriendsController::class,'acceptFriendRequest'])->name('acceptFriendRequest.api');
    Route::get('/getFriends',[FriendsController::class,'getFriends'])->name('getFriends.api');

    Route::post('/recipes/create',[RecipeController::class,'store'])->name('recipes.create');
    Route::post('/upload',[CloudController::class,'upload']);
    Route::post('/fetch',[RecipeController::class,'fetchIP']);
});

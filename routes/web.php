<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgamaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function () {
    return redirect('login');
});

Route::group(
    ['middleware' => ['isNotLogged']],
    function () {
        /**
         * Authentication
         */
        Route::view('/register', 'pages.auth.register');
        Route::view('/login', 'pages.auth.login');
        Route::post('/register', [AuthenticationController::class, 'register']);
        Route::post('/login', [AuthenticationController::class, 'login']);
    }
);

Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('isLogged');

Route::group(
    ['middleware' => ['isAdmin']],
    function () {

        /**
         * Dashboard Routes
         */
        Route::get('/admin/dashboard', [AdminController::class, 'view']);
        Route::post('/admin/agama/{userId}/user', [AdminController::class, 'changeAgama']);
        Route::post('/admin/status/{userId}/user', [AdminController::class, 'changeStatus']);

        /**
         * Agama Routes
         */
        Route::get('/admin/agama', [AgamaController::class, 'view']);
        Route::post('/admin/agama/{agamaId}/delete', [AgamaController::class, 'delete']);
        Route::post('/admin/agama/{agamaId}/update', [AgamaController::class, 'update']);
        Route::post('/admin/agama', [AgamaController::class, 'store']);
    }
);

Route::group(
    ['middleware' => ['isUser']],
    function () {
        /**
         * User Dashboard Routes
         */
        Route::get("/user/dashboard", [ProfileController::class, 'view']);
        Route::post("/user/profile", [ProfileController::class, 'update']);
        Route::post("/user/photo", [ProfileController::class, 'changePhotoProfile']);
        Route::post("/user/photoKTP", [ProfileController::class, 'changePhotoKTP']);
        Route::post("/user/password", [UserController::class, 'changePassword']);
    }
);


Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter']);
Route::get('auth/callback/twitter', [TwitterController::class, 'cbTwitter']);

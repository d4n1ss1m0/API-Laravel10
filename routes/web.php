<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

//CRUD User
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
Route::patch('/user/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//UI User
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}/delete',[UserController::class, 'delete'])->name('users.delete');

//CRUD Company
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/company/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::patch('/company/{company}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
//UI Company
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::get('/companies/{company}/delete',[CompanyController::class, 'delete'])->name('companies.delete');

//CRUD Comment
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comment/{comment}', [CommentController::class, 'show'])->name('comments.show');
Route::patch('/comment/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
//UI Comment
Route::get('/comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::get('/comments/{comment}/delete',[CommentController::class, 'delete'])->name('comments.delete');

//Services routs
Route::get('/company_comments/{id}', [CompanyController::class, 'commentsByID'])->name('company.comments');
Route::get('/company/rate/{id}', [CompanyController::class, 'companyRate'])->name('company.rate');
Route::get('/companies/rating',[CompanyController::class, 'companiesRating'])->name('company.rating');



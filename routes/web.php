<?php

use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\SearchBlogControllor;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

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
#client
Route::get('/testmail', [HomeController::class, 'testmail']);
Route::get('/', [HomeController::class, 'index'])->name('client_home');
Route::get('/login', [LoginController::class, 'index'])->name('client_login');
Route::post('/login', [LoginController::class, 'login'])->name('client_login_');
Route::get('/register', [LoginController::class, 'register'])->name('client_register');
Route::post('/register', [LoginController::class, 'register_'])->name('client_register_');
Route::get('/logout', [LoginController::class, 'logout'])->name('client_logout');
Route::get('/blog', [BlogController::class, 'index'])->name('client_blog');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('client_blog_detail');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('client_category');
Route::post('/post/{post_id}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/post/{post_id}/commentreply', [CommentController::class, 'commentReply'])->name('comment.reply');
Route::get('/refresh-comments/{blogId}', [CommentController::class, 'getComments']);
Route::get('/search', [SearchBlogControllor::class, 'search'])->name('client_blog_search');
Route::post('/search', [SearchBlogControllor::class, 'search'])->name('client_blog_search');
Route::get('/forgot-password', [LoginController::class, 'forgotpassword'])->name('client_forgotpassword');
Route::post('/forgot-password', [LoginController::class, 'forgotpassword_store']);
Route::get('/get-password/{customer}/{token}', [LoginController::class, 'getPass'])->name('client_forgotpassword');
Route::post('/get-password/{customer}/{token}', [LoginController::class, 'getPass_store'])->name('client_forgotpassword_');

// Route::match(['GET', 'POST'], '/search', 'SearchBlogControllor@search');
// Route::match(['GET', 'POST'], '/search', [SearchBlogControllor::class, 'search'])->name('client_blog_search');
#admin
Route::get('/auth/login', [AuthLoginController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthLoginController::class, 'store']);
Route::get('/auth/logout', [AuthLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('admin_blog');
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('admin_blog');
        Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin_category');
        Route::get('/banner', [BannerController::class, 'index'])->name('admin_banner');
        Route::get('/customer', [CustomerController::class, 'index'])->name('admin_customer');
        Route::get('/user', [UserController::class, 'index'])->name('admin_user');
        Route::get('/webconfig', [WebConfigController::class, 'index'])->name('admin_webconfig');
    });
});
Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::prefix('editor')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('editor_blog');
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('editor_blog');
        Route::get('/category', [AdminCategoryController::class, 'index'])->name('editor_category');
        Route::get('/banner', [BannerController::class, 'index'])->name('editor_banner');
    });
});
Route::middleware(['auth', 'role:author'])->group(function () {
    Route::prefix('author')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('author_blog');
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('author_blog');
    });
});

Route::post('/blog/add', [AdminBlogController::class, 'store'])->name('blog_add');
Route::get('/blog/edit/{id}', [AdminBlogController::class, 'edit'])->name('blog_edit');
Route::post('/blog/edit/{id}', [AdminBlogController::class, 'update'])->name('blog_edit');
Route::delete('/blog/delete/{id}', [AdminBlogController::class, 'destroy']);

Route::post('/category/add', [AdminCategoryController::class, 'store'])->name('category_add');
Route::get('/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('category_edit');
Route::post('/category/edit/{id}', [AdminCategoryController::class, 'update'])->name('category_edit');
Route::delete('/category/delete/{id}', [AdminCategoryController::class, 'destroy']);

Route::post('/banner/add', [BannerController::class, 'store'])->name('category_add');
Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('category_edit');
Route::post('/banner/edit/{id}', [BannerController::class, 'update'])->name('category_edit');
Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy']);

Route::post('/customer/add', [CustomerController::class, 'store'])->name('category_add');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('category_edit');
Route::post('/customer/edit/{id}', [CustomerController::class, 'update'])->name('category_edit');
Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy']);

Route::post('/user/add', [UserController::class, 'store'])->name('user_add');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user_edit');
Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('user_edit');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

Route::get('/webconfig/edit/{id}', [WebConfigController::class, 'edit'])->name('webconfig_edit');
Route::post('/webconfig/edit/{id}', [WebConfigController::class, 'update'])->name('webconfig_edit');

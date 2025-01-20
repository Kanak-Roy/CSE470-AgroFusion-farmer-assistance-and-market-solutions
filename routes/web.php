<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/addagents', [AdminController::class, 'addagents']);
Route::post('/addnewagents', [AdminController::class, 'addnewagents']);
Route::get('/adminProfile', [AdminController::class, 'adminProfile']);

Route::get('/ourCustomers', [AdminController::class, 'ourCustomers']);
Route::get('/changeUserStatus/{status}/{id}', [AdminController::class, 'changeUserStatus']);

Route::get('/ourAgents', [AdminController::class, 'ourAgents']);
Route::get('/changeAgentStatus/{status}/{id}', [AdminController::class, 'changeAgentStatus']);

Route::get('/agent', [AgentController::class, 'index']);
Route::get('/agentProfile', [AgentController::class, 'agentProfile']);
Route::get('/addproducts', [AgentController::class, 'addproducts']);
Route::POST('/addnewproduct', [AgentController::class, 'addnewproduct']);
Route::get('/deleteproduct/{id}', [AgentController::class, 'deleteproduct']);

Route::get('/', [MainController::class, 'index']);
Route::get('/cart', [MainController::class, 'cart']);
// Route::get('/checkout', [MainController::class, 'checkout']);
Route::get('/shop', [MainController::class, 'shop']);
Route::get('/single/{id}', [MainController::class, 'singleProduct']);
Route::get('/profile', [MainController::class, 'profile']);

Route::get('/register', [MainController::class, 'register']);
Route::get('/login', [MainController::class, 'login']);
Route::get('/logout', [MainController::class, 'logout']);

Route::post('/registerUser', [MainController::class, 'registerUser']);
Route::post('/loginUser', [MainController::class, 'loginUser']);
Route::post('/updateUser', [MainController::class, 'updateUser']);
Route::post('/addToCart', [MainController::class, 'addToCart']);
Route::post('/updateCart', [MainController::class, 'updateCart']);
Route::get('/deleteCartItem/{id}', [MainController::class, 'deleteCartItem']);

Route::get('/search', [MainController::class, 'searchProduct']);
Route::get('/shop', [MainController::class, 'sortProduct']);


// Done by Kanak
Route::get('/checkout', [MainController::class, 'checkout']);
Route::get('/myOrders', [MainController::class, 'myOrders']);
Route::get('/ourOrders', [AdminController::class, 'orders']);
Route::get('/changeUserStatus/{status}/{id}', [AdminController::class, 'changeUserStatus']);
Route::get('/changeOrderStatus/{status}/{id}', [AdminController::class, 'changeOrderStatus']);
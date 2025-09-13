<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/employees', [AdminController::class, 'employees'])->name('employees');
        Route::post('/employees', [AdminController::class, 'storeEmployee'])->name('employees.store');
        Route::get('/employees/{id}/edit', [AdminController::class, 'editEmployee'])->name('employees.edit');
        Route::put('/employees/{id}', [AdminController::class, 'updateEmployee'])->name('employees.update');
        Route::delete('/employees/{id}', [AdminController::class, 'deleteEmployee'])->name('employees.delete');
        
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');
        
        Route::get('/purchases', [AdminController::class, 'purchases'])->name('purchases');
    });
    
    Route::middleware(['role:Employee'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
        Route::get('/customers', [EmployeeController::class, 'customers'])->name('customers');
        Route::post('/customers', [EmployeeController::class, 'storeCustomer'])->name('customers.store');
        Route::get('/customers/{id}/edit', [EmployeeController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [EmployeeController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [EmployeeController::class, 'deleteCustomer'])->name('customers.delete');
        
        Route::get('/purchases', [EmployeeController::class, 'purchases'])->name('purchases');
        Route::post('/purchases', [EmployeeController::class, 'storePurchase'])->name('purchases.store');
        Route::get('/purchases/{id}/edit', [EmployeeController::class, 'editPurchase'])->name('purchases.edit');
        Route::put('/purchases/{id}', [EmployeeController::class, 'updatePurchase'])->name('purchases.update');
        Route::delete('/purchases/{id}', [EmployeeController::class, 'deletePurchase'])->name('purchases.delete');
    });
    
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/products/{product}', function(Product $product){
    $product = Product::where('id', $product->id)->with(['currency'])->first();
    return Inertia::render('ProductDetail',[
        'product' => $product
    ]);
})->name('productDetail');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {

    Route::post('/products/{product}/checkout', [ProductController::class, 'checkout'])->name('admin.products.checkout');
    Route::get('/products/{product}/checkout', function(Product $product){
        $product = Product::where('id', $product->id)->with(['currency'])->first();
        return Inertia::render('ProductCheckout',[
            'product' => $product
        ]);
    })->name('productCheckout');
    
    Route::name('admin.')->middleware('isAdmin')->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
    });

});

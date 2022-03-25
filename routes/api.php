<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products', function (Request $request) {
    return \App\Models\Product::query()
        ->when($request->filled('productName'), function ($query) use ($request){
            $query->where('name', 'LIKE', "%". $request->get('productName') ."%");
        })
        ->when($request->filled('publishDate'), function ($query) use ($request){
            $query->where('publish_date', 'LIKE', "%". $request->get('publishDate') ."%");
        })
        ->whereHas('author',function ($query) use ($request) {
            $query->when($request->filled('authorName'), function ($q) use ($request) {
                $q->where('name', 'LIKE', "%" . $request->get('authorName') . "%");
            });
        })
        ->with('author')->paginate(15);
});

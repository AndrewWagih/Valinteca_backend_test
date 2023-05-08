<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CreateRequest;
use App\Http\Controllers\QuestionNineController;
use App\Jobs\MailtrapJob;
use App\Jobs\ExternalApiJob;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products',function(){
    $products = Product::get();
    return response()->json([
        'data' => $products
    ]);
});

Route::post('request-dates',function(CreateRequest $request){
    return response()->json($request->all());
});


Route::get('posts-starts-with-d',[QuestionNineController::class,'getPostsStartingWithD']);

Route::get('send-mail',function(){
    MailtrapJob::dispatch();
    return response()->json('please run queue:work to test');
});


Route::get('external-api-job',function(){
    for($i=0;$i <1000 ;$i++){
        ExternalApiJob::dispatch()->delay(60*$i);
    };
    return response()->json('please run queue:work to test');
});
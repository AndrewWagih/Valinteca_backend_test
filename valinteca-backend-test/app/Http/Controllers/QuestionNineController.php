<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuestionNineController extends Controller
{

    /* 
        notes :-
        you will found postman collection with questions key to test code in https://github.com/AndrewWagih/Valinteca_backend_test/blob/main/task%20backend.postman_collection.json
    
    */
    
    public function getPostsStartingWithD()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = collect($response->json())->filter(function ($post) {
            return str_starts_with($post['title'], 'd');
        });

        return $posts;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuestionNineController extends Controller
{
    public function getPostsStartingWithD()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = collect($response->json())->filter(function ($post) {
            return str_starts_with($post['title'], 'd');
        });

        return $posts;
    }
}

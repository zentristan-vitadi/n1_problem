<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): View
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $posts = Post::with('author')->latest('published_at')->paginate(10);


        return view('posts.index', [
            'posts' => $posts,
            'queryCount' => count(DB::getQueryLog()),
        ]);
    }

    public function report(): View
    {
        DB::flushQueryLog();
        DB::enableQueryLog();
        
        $posts = Post::with(['author', 'category', 'tags', 'comments'])->latest('published_at')->paginate(20);

       

        return view('posts.report', [
            'posts' => $posts,
            'queryCount' => count(DB::getQueryLog()),
        ]);
    }
}

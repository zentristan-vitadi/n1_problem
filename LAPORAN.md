Nama : Zentristan Vitadi
Kelas : XI-3

1. Karena pola penulisan kode dan penggunakan alat bantu pengelolaan database 

2. File app/Http/Controllers/PostController.php

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

- Jumlah Query Sebelum (Post)= 52
- Jumlah Query Sesudah (Post)= 3

- Jumlah Query Sebelum (Relasi)= 200
- Jumlah Query Sesudah (Relasi)= 6



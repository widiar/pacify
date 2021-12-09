<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $articles = Article::orderBy('updated_at', 'desc')->take(3)->get();
        return view('home', compact('articles'));
    }

    public function article($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('article', compact('article'));
    }
}

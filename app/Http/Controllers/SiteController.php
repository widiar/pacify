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
        $data = Article::where('slug', $slug)->firstOrFail();
        $articles = Article::orderBy('updated_at', 'desc')->where('slug', '!=', $slug)->take(3)->get();
        return view('article', compact('data', 'articles'));
    }
}

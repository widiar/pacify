<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function diaryPost(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json('Login');
            } else {
                $user = Auth::user();
                Diary::create([
                    'user_id' => $user->id,
                    'konten' => $request->diary
                ]);
                return response()->json('Success');
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}

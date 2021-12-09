<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::all();
        return view('admin.article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'poster' => 'required|image|mimes:png,jpeg|max:5120',
            'ket_gambar' => '',
            'content' => 'required'
        ]);
        $poster = $request->poster;
        Article::create([
            'judul' => $request->title,
            'gambar' => $poster->hashName(),
            'keterangan_gambar' => $request->ket_gambar,
            'konten' => $request->content
        ]);
        $poster->storeAs('public/article', $poster->hashName());
        return redirect()->route('admin.article.index')->with('success', 'Berhasil menambah artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Article::find($id);
        return view('admin.article.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'poster' => 'image|mimes:png,jpeg|max:5120',
            'ket_gambar' => '',
            'content' => 'required'
        ]);
        $data = Article::find($id);
        $img = $request->file('poster');
        if ($img) {
            Storage::disk('public')->delete('article/' . $data->gambar);
            $img->storeAs('public/article', $img->hashName());
            $data->gambar = $img->hashName();
        }
        $data->judul = $request->title;
        $data->keterangan_gambar = $request->ket_gambar;
        $data->konten = $request->content;
        $data->save();
        return redirect()->route('admin.article.index')->with('success', 'Berhasil update artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

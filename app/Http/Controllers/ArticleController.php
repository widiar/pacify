<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class ArticleController extends Controller
{
    private function imagekit()
    {
        return new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_SECRET_KEY'),
            env('IMAGE_KIT_ENDPOINT')
        );
    }
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
            'content' => 'required',
            'slug' => 'required|unique:articles,slug'
        ]);
        $poster = $request->poster;
        $imageKit = $this->imagekit();
        $uploadFile = $imageKit->upload([
            'file' => fopen($poster->getPathname(), "r"),
            'fileName' => $poster->hashName(),
            'folder' => "pacify//article//"
        ]);
        Article::create([
            'judul' => $request->title,
            'gambar' => json_encode([
                'field' => $uploadFile->success->fileId,
                'url' =>  $uploadFile->success->url
            ]),
            'keterangan_gambar' => $request->ket_gambar,
            'konten' => $request->content,
            'slug' => $request->slug
        ]);
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
            $imageKit = $this->imagekit();
            $uploadFile = $imageKit->upload([
                'file' => fopen($img->getPathname(), "r"),
                'fileName' => $img->hashName(),
                'folder' => "pandan-sari//water-sport//"
            ]);
            $imageKit->deleteFile(json_decode($data->gambar)->field);
            $data->gambar = json_encode([
                'field' => $uploadFile->success->fileId,
                'url' =>  $uploadFile->success->url
            ]);
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
        try {
            $data = Article::find($id);
            $imageKit = $this->imagekit();
            $imageKit->deleteFile(json_decode($data->gambar)->field);
            $data->delete();
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}

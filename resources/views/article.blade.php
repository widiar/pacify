@extends('template.master')

@section('title', 'Pacify - Article')

@section('css')
<link rel="stylesheet" href="{{ asset('css/article.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive-article.css') }}">
@endsection

@section('main-content')
<main>
    <div class="articleContainer">
        <h1>{{ $article->judul }}</h1>
        <p class="date">{{ date('j F Y', strtotime($article->updated_at)) }}</p>
        <img src="{{ Storage::url('article/') . $article->gambar }}" alt="Article Image">
        <br>
        <a href="#">{{ $article->keterangan_gambar }}</a>
        <br>
        {!! $article->konten !!}
    </div>
    <div class="newsContainer">
        <div class="headingNews">
            <h3>What's New?</h3>
            <p>All things that might helps you get through a hard time</p>
        </div>
        <div class="listNews">
            <div class="news">
                <img src="{{ asset('img/article-1.jpg') }}" alt="article picture" />
                <p>24 Nov 2021</p>
                <p class="newsTitle">
                    7 Alasan penggunaan masalah yang ada di masyarakat
                    sekitar
                </p>
            </div>
            <div class="news">
                <img src="{{ asset('img/article-2.jpg') }}" alt="article picture" />
                <p>24 Nov 2021</p>
                <p class="newsTitle">7 Alasan penggunaan masalah</p>
            </div>
            <div class="news">
                <img src="{{ asset('img/article-3.jpg') }}" alt="article picture" />
                <p>24 Nov 2021</p>
                <p class="newsTitle">7 Alasan penggunaan masalah</p>
            </div>
        </div>
    </div>
</main>
@endsection
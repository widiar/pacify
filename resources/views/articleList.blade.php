@extends('template.master')

@section('title', 'Diary Post')

@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}" />
<link rel="stylesheet" href="{{ asset('css/responsive-article-list.css') }}" />
@endsection

@section('main-content')
<main>
    <h1>ARTICLE LIST</h1>
    <div class="articleList">
        @foreach ($articles as $article)
        <div class="article">
            <a href="{{ route('article', $article->slug) }}">
                <img src="{{ Storage::url('article/') . $article->gambar }}" alt="Article Image">
                <div class="articleContent">
                    <h2>{{ $article->judul }}</h2>
                    <p class="date">{{ date('j M Y', strtotime($article->updated_at)) }}</p>
                    {{-- <p class="content">
                        {!! $article->konten !!}
                    </p> --}}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</main>
@endsection

@section('script')

@endsection
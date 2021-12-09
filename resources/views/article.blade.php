@extends('template.master')

@section('title', 'Pacify - Article')

@section('css')
<link rel="stylesheet" href="{{ asset('css/article.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive-article.css') }}">
@endsection

@section('main-content')
<main>
    <div class="articleContainer">
        <h1>{{ $data->judul }}</h1>
        <p class="date">{{ date('j F Y', strtotime($data->updated_at)) }}</p>
        <img src="{{ Storage::url('article/') . $data->gambar }}" alt="Article Image">
        <br>
        <a href="#">{{ $data->keterangan_gambar }}</a>
        <br>
        {!! $data->konten !!}
    </div>
    @include('template.article')
</main>
@endsection
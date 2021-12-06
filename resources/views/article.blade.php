@extends('template.master')

@section('title', 'Pacify - Article')

@section('css')
<link rel="stylesheet" href="{{ asset('css/article.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive-article.css') }}">
@endsection

@section('main-content')
<main>
    <div class="articleContainer">
        <h1>Lorem Ipsum is simply dummy </h1>
        <p class="date">24 November 2021</p>
        <img src="{{ asset('img/article-1.jpg') }}" alt="Article Image">
        <br>
        <a href="https://www.freepik.com/photos/woman">Woman photo created by rawpixel.com - www.freepik.com</a>
        <br>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard
            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
            type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining
            essentially unchanged.
        </p>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard
            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
            type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining
            essentially unchanged.
        </p>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard
            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
            type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining
            essentially unchanged.
        </p>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard
            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
            type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining
            essentially unchanged.
        </p>
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
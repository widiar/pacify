@extends('template.master')

@section('title', 'Pacify')

@section('header')
@include('template.jumbotron')
@endsection

@section('main-content')
<main>
    <div class="mottoContainer">
        <div class="quotes">
            <h2>Quotes</h2>
        </div>
        <div class="textQuotes">
            <p>
                “Happiness can be found even in the darkest of times, if
                one only remembers to turn on the light.”
            </p>
            <br />
            <p class="quoteWriter">Albus Dumbledore</p>
        </div>
    </div>
    <div class="newsContainer">
        <div class="headingNews">
            <h3>What's New?</h3>
            <p>
                All things that might helps you get through a hard time
            </p>
        </div>
        <div class="listNews">
            <div class="news">
                <img src="{{ asset('img/article-1.jpg') }}" alt="article picture" />
                <p>24 Nov 2021</p>
                <a href="{{ route('article') }}" style="text-decoration: none" class="newsTitle">
                    7 Alasan penggunaan masalah yang ada di masyarakat
                    sekitar
                </a>
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
    <div class="diaryContainer">
        <div class="headingDiary">
            <h3>What's New?</h3>
            <p>
                All things that might helps you get through a hard time
            </p>
        </div>
        <div class="contentDiary">
            <form action="">
                <textarea class="textDiary" name="diary" id="textDiary" cols="30" rows="10" maxlength="200"
                    minlength="3" placeholder="Grateful things or rough times to tell"></textarea>
                <input type="submit" value="submit" />
            </form>
        </div>
    </div>
    <div class="badDay">
        <div class="imgBadDay">
            <img src="{{ asset('img/badDay.jpg') }}" alt="Picture of someone hugging herself" />
        </div>
        <div class="contentBadDay">
            <h3>Having a Bad Day?</h3>
            <p>
                Remember those diaries you wrote? yeah, we collect it
                all just for you in case you need it. See how far you’ve
                come in just one click.
            </p>
            <button>Explore</button>
        </div>
    </div>
</main>
@endsection
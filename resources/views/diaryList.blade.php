@extends('template.master')

@section('title', 'Diaries')

@section('css')
<link rel="stylesheet" href="{{ asset('css/diaryStorage.css') }}" />
@endsection

@section('main-content')
<main>
    <div class="diaryStorageContainer">
        <h1>Look How Far You've Come!</h1>
        <div class="diaryList">
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="{{ route('diary') }}">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
            <div class="diaries">
                <h2>16 Oct 2021</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an...
                </p>
                <a href="#">click for more</a>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
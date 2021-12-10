@extends('template.master')

@section('title', 'Diaries')

@section('css')
<link rel="stylesheet" href="{{ asset('css/diaryStorage.css') }}" />
@endsection

@section('main-content')
<main>
    <div class="diaryStorageContainer">
        <h1>Look How Far You've Come!</h1>
        @foreach ($diaries as $diary)
        <div class="diaryList">
            <div class="diaries">
                <h2>{{ date('j M Y', strtotime($diary->updated_at)) }}</h2>
                <p>
                    {{ $diary->konten }}
                </p>
                <a href="{{ route('diary', $diary->id) }}">click for more</a>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection

@section('script')

@endsection
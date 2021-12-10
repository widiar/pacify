@extends('template.master')

@section('title', 'Diary Post')

@section('css')
<link rel="stylesheet" href="{{ asset('css/diaryPost.css') }}" />
@endsection

@section('main-content')
<main>
    <div class="diaryPostContainer">
        <h1>DIARY</h1>

        <div class="contentDiaryPost">
            <h2>{{ date('j F Y', strtotime($diary->updated_at)) }}</h2>
            <p>
                {{ $diary->konten }}
            </p>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
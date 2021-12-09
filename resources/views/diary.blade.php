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
            <h2>16 October 2021</h2>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard
                dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                essentially unchanged.
            </p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard
                dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                essentially unchanged.
            </p>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
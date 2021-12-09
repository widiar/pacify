@extends('template.master')

@section('title', 'Diary Post')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
<link rel="stylesheet" href="{{ asset('css/responsive-chat.css') }}" />
@endsection

@section('main-content')
<main>
    <h1>Messages</h1>
    <div class="chatContainer">

        <div class="chatMenu">
            <div class="search">
                <input type="text" placeholder="Search">
            </div>
            <div class="listContacts">
                <div class="contact">
                    <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                    <div class="contactPersonal">
                        <h2>Thomas</h2>
                        <p>Hi there, how are you?</p>
                    </div>
                </div>
                <div class="contact">
                    <img src="{{ asset('img/contact-2.jpg') }}" alt="Profile Picture Chat">
                    <div class="contactPersonal">
                        <h2>Jessica</h2>
                        <p>Hi there, how are you?</p>
                    </div>
                </div>
                <div class="contact">
                    <img src="{{ asset('img/contact-3.jpg') }}" alt="Profile Picture Chat">
                    <div class="contactPersonal">
                        <h2>Peter</h2>
                        <p>Hi there, how are you?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contentChat">
            <div class="nameChat">
                <h2>Thomas</h2>
            </div>
            <div class="chatIncomeContainer">
                <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                <div class="chatIncome">
                    <p>Hi there, How are you?</p>
                </div>
            </div>
            <div class="chatOutcomeContainer">
                <div class="chatOutcome">
                    <p>Not really good tho. And you?</p>
                </div>
            </div>
            <div class="chatIncomeContainer">
                <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                <!-- Kalau user submit lebih dari 2 chat, maka muncul div baru dengan class chats -->
                <div class="chats">
                    <div class="chatIncome">
                        <p>it’s been a roller coaster week tho. but thank God i managed it all.</p>
                    </div>
                    <div class="chatIncome">
                        <p>are you okay?</p>
                    </div>
                </div>
            </div>
            <div class="chatOutcomeContainer">
                <div class="chatOutcome">
                    <p>uhmm.. not exactly. would you hear me out?</p>
                </div>
            </div>
            <div class="chatIncomeContainer">
                <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                <div class="chatIncome">
                    <p>Sure. I’m all ears</p>
                </div>
            </div>

            <div class="chatType">
                <div class="contentChatType">
                    <input type="text" placeholder="Type a message">
                    <button><i class="fas fa-paper-plane"></i></button>
                </div>
                <!-- <div class="submitChat">
                        <input type="submit" value="">
                    </div> -->
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
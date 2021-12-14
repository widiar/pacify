@extends('template.master')

@section('title', 'Chat')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
<link rel="stylesheet" href="{{ asset('css/responsive-chat.css') }}" />

<style>
    .room:hover {
        cursor: pointer;
    }
</style>
@endsection

@section('main-content')
<main>
    <h1>Messages</h1>
    <button class="btn btn-chat">Mulai Chat</button>
    <div class="chatContainer">

        <div class="chatMenu">
            <div class="search">
                <input type="text" placeholder="Search">
            </div>
            <div class="listContacts">
                @foreach ($rooms as $room)
                <div class="contact">
                    <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                    <div class="contactPersonal">
                        <h2 class="room" data-nama="{{{ $room->nama }}}">{{ $room->nama }}</h2>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="contentChat emptyChat">
            <div class="nameChat">
                <h2>Thomas</h2>
            </div>
            <div class="chatIncomeContainer">
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
                <div class="chatIncome">
                    <p>Hi there, How are you?</p>
                </div>
            </div>
        </div>
        <div class="contentChat roomChat" style="display: none">
            <div class="nameChat">
                <h2>Thomas</h2>
            </div>

            <div class="chatIncomeContainer">
                <div class="chatIncome">
                    <p>Hi there, How are you?</p>
                </div>
            </div>
            <div class="chatOutcomeContainer">
                <div class="chatOutcome">
                    <p>Not really good tho. And you?</p>
                </div>
            </div>

            <div class="chatType">
                <form action="" class="chatForm" data-id="" method="POST">
                    <div class="contentChatType">
                        <input name="message" type="text" id="msg" placeholder="Type a message">
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    const urlSearch = `{{ route('chat.search') }}`
    let cari
    let iUser, iRoom, iWaktu
    const search = () => {
        $.ajax({
            url: urlSearch,
            method: 'POST',
            success: (res) => {
                console.log(res.status)
                if (res.status == 'Found User') {
                    clearInterval(cari)
                    const html = `
                    <div class="contact">
                        <img src="{{ asset('img/contact-1.jpg') }}" alt="Profile Picture Chat">
                        <div class="contactPersonal">
                            <h2 class="room" data-nama="${res.room}">${res.room}</h2>
                        </div>
                    </div>
                    `
                    $('.listContacts').append(html)
                }
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    }
    $('.btn-chat').click(function(e){
        console.log("Searching...")
        cari = setInterval(search, 5000)
        $(this).attr('disabled', 'disabled')
    })

    const listenChat = () => {
        const url = `{{ route('listen.chat') }}`
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                userId: iUser,
                roomId: iRoom,
                waktu: iWaktu
            },
            success: (res) => {
                console.log(res)
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    }

    const showChat = (nama) => {
        const url = `{{ route('show.chat') }}`
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                nama: nama
            },
            success: (res) => {
                $('.chatForm').data('id', res.room)
                const date = new Date()
                iWaktu = `${date.getFullYear()}-${(date.getMonth()+1)}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`
                iUser = res.id
                iRoom = res.room
                setInterval(listenChat, 1000)
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    }

    $('.room').click(function(e){
        const nama = $(this).data('nama')
        showChat(nama)

        $('.emptyChat').hide()
        $('.roomChat').show()
    })

    $('.chatForm').submit(function(e){
        e.preventDefault()
        const url = `{{ route('post.chat') }}`
        const idRoom = $('.chatForm').data('id')
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                msg: $('#msg').val(),
                roomId: idRoom
            },
            success: (res) => {
                console.log(res)
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    })

</script>
@endsection
@extends('template.master')

@section('title', 'Chat')

@section('css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
<link rel="stylesheet" href="{{ asset('css/responsive-chat.css') }}" />

<style>
    .room,
    .btn-chat:hover {
        cursor: pointer;
    }
</style>
@endsection

@section('main-content')
<main>
    <div class="emptysChat" style="text-align: center">
        <h1 class="getStartedHeading">One click away from starting to have a conversation with others!</h1>
        <button class="getStartedButton btn-chat">Get Started</button>
    </div>
    <div class="notemptychat">
        <h1>Messages</h1>
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
                <h3 class="chatEmpty" style="margin-bottom: 50px;">Whoops! click any chat to begin. Or Start New Chat
                </h3>
                <div style="text-align: center">
                    <button class="getStartedButton btn-chat" style="margin-bottom: 200px;">Start Chat</button>
                </div>
            </div>
            <div class="contentChat roomChat" style="display: none">
                <div class="nameChat">
                    <h2>Thomas</h2>
                </div>

                <div class="chat">

                </div>

                <div class="chatType">
                    <form action="" class="chatForm" data-id="" method="POST">
                        <div class="contentChatType">
                            <input name="message" type="text" id="msg" placeholder="Type a message">
                            <button type="submit" id="btn-submit"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    const urlSearch = `{{ route('chat.search') }}`
    const cRoom = `{{ $hitungRoom }}`
    let cari

    const listen = (idRoom) => {
        window.Echo.private(`chat.${idRoom}`).listen('ChatCreated', (res) => {
            const html = `
                <div class="chatIncomeContainer">
                    <div class="chatIncome">
                        <p>${res.chat.body}</p>
                    </div>
                </div>`
            $('.chat').append(html)
        })
    }
    $(document).ready(() => {
        if(cRoom > 0) {
            $('.notemptychat').show()
            $('.emptysChat').hide()
        } else {
            $('.notemptychat').hide()
            $('.emptysChat').show()
        }
    })
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
                    $('.notemptychat').show()
                    $('.emptysChat').hide()
                }
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    }
    $('.btn-chat').click(function(e){
        console.log("Searching...")
        cari = setInterval(search, 3000)
        $(this).attr('disabled', 'disabled')
    })

    const showChat = (nama) => {
        const url = `{{ route('show.chat') }}`
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                nama: nama
            },
            success: (res) => {
                $('.chatForm').data('id', res.room.id)
                $('.chat').html('')
                res.chats.forEach((chat) => {
                    let html = '';
                    if(res.userId == chat.user_id) {
                        html = `
                        <div class="chatOutcomeContainer">
                            <div class="chatOutcome">
                                <p>${chat.body}</p>
                            </div>
                        </div>`
                    }else{
                        html = `
                        <div class="chatIncomeContainer">
                            <div class="chatIncome">
                                <p>${chat.body}</p>
                            </div>
                        </div>`
                    }
                    $('.chat').append(html)
                })
                listen(res.room.nama)
                if(res.room.is_disabled == true) {
                    $('#msg').attr('disabled', 'disabled')
                    $('#msg').attr('placeholder', 'You can\'t chat with this person again.')
                    $('#btn-submit').attr('disabled', 'disabled')
                }else{
                    $('#msg').removeAttr('disabled')
                    $('#msg').attr('placeholder', 'Type a message')
                    $('#btn-submit').removeAttr('disabled')
                }
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    }

    $(document).on('click', '.room', function(e){
        const nama = $(this).data('nama')
        showChat(nama)
        $('.nameChat h2').text(nama)

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
                const html = `
                    <div class="chatOutcomeContainer">
                        <div class="chatOutcome">
                            <p>${res.body}</p>
                        </div>
                    </div>`
                $('.chat').append(html)
                $('#msg').val(null)
            },
            error: (res) => {
                console.log(res.responseJSON)
            }
        })
    })

</script>
@endsection
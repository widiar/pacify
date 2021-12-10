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
    @include('template.article')
    <div class="diaryContainer">
        <div class="headingDiary">
            <h3>What's New?</h3>
            <p>
                All things that might helps you get through a hard time
            </p>
        </div>
        <div class="contentDiary">
            <form action="{{ route('diary.post') }}" method="POST" id="formDiary">
                <textarea class="textDiary" required name="diary" id="textDiary" cols="30" rows="10" maxlength="200"
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

@section('script')
<script>
    $('#formDiary').submit(function(e){
        e.preventDefault()
        const urlLogin = `{{ route('login') }}`
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: (res) => {
                if(res == 'Login') {
                    Swal.fire(
                        'Login',
                        'Mohon Login Terlebih Dahulu',
                        'warning'
                    ).then(result => {
                        if(result.isConfirmed) window.location.href = urlLogin
                    })
                } else {
                    Swal.fire({
                      title: 'Success!',
                      text: `Berhasil nambah diary.`,
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                        $('#textDiary').val(null)
                    })
                }
            },
            error: (res) => {
                console.log(res.responseJSON)
                Swal.fire("Oops", "Something Wrong!", "error");
            }
        })
    })
</script>
@endsection
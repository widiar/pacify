<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capstone Project</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
    <header>
        <div class="app-bar">
            <div class="app-bar__menu">
                <button id="hamburgerButton">☰</button>
            </div>
            <div class="app-bar__brand">
                <img src="../img/pacify-logo.png" alt="Logo Pacify">
            </div>
            <nav id="navigationDrawer" class="app-bar__navigation">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Article</a></li>
                    <li><a href="#">Diary</a></li>
                    <button class="loginButton">Login</button>
                    <!-- <li><a href="#" id="loginButton" class="loginButton">Login</a></li> -->
                </ul>
            </nav>
        </div>

        <div class="jumbotron">
            <div class="imageJumbotron">
                <img src="../img/imageJumbotron.png" alt="jumbotron image">
            </div>
            <div class="textJumbotron">
                <h1>You Deserve to be Happy!</h1>
                <p>Pacify is an app that helps you go through all of your bad days.</p>
                <button>Explore</button>
            </div>
        </div>
    </header>
    <main>
        <div class="mottoContainer">
            <div class="quotes">
                <h2>Quotes</h2>
            </div>
            <div class="textQuotes">
                <p>“Happiness can be found even in the darkest of times, if one only remembers to turn on the light.”</p><br>
                <p class="quoteWriter">Albus Dumbledore</p>
            </div>
        </div>
        <div class="newsContainer">
            <div class="headingNews">
                <h3>What's New?</h3>
                <p>All things that might helps you get through a hard time</p>
            </div>
            <div class="listNews">
                <div class="news">
                    <img src="{{ asset('img/article-1') }}" alt="article picture">
                    <p>24 Nov 2021</p>
                    <p class="newsTitle">7 Alasan penggunaan masalah yang ada di masyarakat sekitar</p>
                </div>
                <div class="news">
                    <img src="../img/article-2.jpg" alt="article picture">
                    <p>24 Nov 2021</p>
                    <p class="newsTitle">7 Alasan penggunaan masalah</p>
                </div>
                <div class="news">
                    <img src="../img/article-3.jpg" alt="article picture">
                    <p>24 Nov 2021</p>
                    <p class="newsTitle">7 Alasan penggunaan masalah</p>
                </div>
            </div>
        </div>
        <div class="diaryContainer">
            <div class="headingDiary">
                <h3>What's New?</h3>
                <p>All things that might helps you get through a hard time</p>
            </div>
            <div class="contentDiary">
                <form action="">
                    <textarea class="textDiary" name="diary" id="textDiary" cols="30" rows="10" maxlength="200" minlength="3" placeholder="Grateful things or rough times to tell"></textarea>
                    <input type="submit" value="submit">
                </form>
            </div>
        </div>
        <div class="badDay">
            <div class="imgBadDay">
                <img src="../img/badDay.jpg" alt="Picture of someone hugging herself">
            </div>
            <div class="contentBadDay">
                <h3>Having a Bad Day?</h3>
                <p>Remember those diaries you wrote? yeah, we collect it all just for you in case you need it. See how far you’ve come in just one click.</p>
                <button>Explore</button>
            </div>
        </div>
    </main>
    <footer>
        <p>© Pacify 2021. All rights reserved </p>
    </footer>
</body>

</html>
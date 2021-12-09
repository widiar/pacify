<div class="newsContainer">
    <div class="headingNews">
        <h3>What's New?</h3>
        <p>
            All things that might helps you get through a hard time
        </p>
    </div>
    <div class="listNews">
        @foreach ($articles as $article)
        <div class="news">
            <img src="{{ json_decode($article->gambar)->url  }}" alt="article picture" />
            <p>{{ date('j M Y', strtotime($article->updated_at)) }}</p>
            <a href="{{ route('article', $article->slug) }}" style="text-decoration: none" class="newsTitle">
                {{ $article->judul }}
            </a>
        </div>
        @endforeach
    </div>
</div>
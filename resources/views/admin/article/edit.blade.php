@extends('admin.template.admin')

@section('title', 'Edit Artikel')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.article.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" required class="form-control  @error('title') is-invalid @enderror"
                    value="{{ old('title', $data->judul) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" readonly class="form-control  @error('slug') is-invalid @enderror"
                    value="{{ old('slug', $data->slug) }}">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="poster">Poster</label>
                <div class="custom-file">
                    <input type="file" name="poster"
                        class="file custom-file-input @error('poster') is-invalid @enderror" id="poster"
                        value="{{ old('poster') }}" accept="image/x-png, image/jpeg">
                    <label class="custom-file-label" for="poster">
                        <span class="d-inline-block text-truncate w-75">Browse File</span>
                    </label>
                    <a href="{{ Storage::url('article/') . $data->gambar }}" target="_blank">
                        <small class="text-primary">Lihat Gambar</small>
                    </a>
                    @error("poster")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            <div class="form-group">
                <label for="ket_gambar">Keterangan Poster</label>
                <input type="text" name="ket_gambar" class="form-control  @error('ket_gambar') is-invalid @enderror"
                    value="{{ old('ket_gambar', $data->keterangan_gambar) }}">
                @error('ket_gambar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Konten</label>
                <textarea type="text" required name="content" id="content"
                    class="form-control @error('content') is-invalid @enderror">{{ old('content', $data->konten) }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-block btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace('content');
</script>
@endsection
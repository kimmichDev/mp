@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card shadow">
                    <div class="card-body p-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Articles</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @inject('cat', '\App\Category')
            <div class="col-12 col-md-8 mt-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-item-center mb-4">
                            <h4>Edit Article</h4>
                            <i class="feather-edit-3 h5 ml-2 text-info"></i>
                        </div>
                        @if (session('status'))
                            {!! session('status') !!}
                        @endif
                        <form action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required class="form-control" name="title" value="{{ $article->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Poster</label>
                                <input type="file" class="form-control p-1" name="poster">
                            </div>
                            <div class="form-group">
                                <label for="">Download Link *Optional</label>
                                <input type="text" class="form-control p-1" name="download" value="{{ $article->download }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Content</label>
                                <textarea name="content" id="content" rows="30" class="form-control">{{ $article->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="custom-select" required name="category_id">
                                    @foreach ($cat->all() as $item)
                                        <option value="{{ $item->id }}" class="" @if ($item->id == $article->category_id) selected @endif>
                                            {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="viewers">Viewers</label>
                                <input type="text" required class="form-control" name="viewers" value="{{ $article->viewers }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ratings">Ratings</label>
                                <input type="number" value="{{ $article->ratings }}" min="1" max="5" placeholder="must not greater than 5" required class="form-control" name="ratings"
                                    value="{{ old('ratings') }}" required>
                            </div>
                            <button class="btn btn-primary">Edit Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#content').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['height', 50]
            ],
            height: 200
        });
    </script>
@endsection

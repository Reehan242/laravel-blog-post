@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                <div class="input-group mb-3">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @elseif (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <input type="text" class="form-control" placeholder="Search Post" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            @if ($posts[0]->image)
                <div style="max-height:300px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top img-fluid">
                </div>
            @else
                <img src="https://picsum.photos/1200/300" class="card-img-top" alt="{{ $posts[0]->category->name }}">
            @endif
            <div class="card-body text-center">
                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">
                    <h3 class="card-title">{{ $posts[0]->title }}</h3>
                </a>
                <p>
                    <small class="text-body-secondary">
                        By. <a href="/posts?author={{ $posts[0]->author->username }} "
                            class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a
                            href="/posts?category={{ $posts[0]->category->slug }}"
                            class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>

                <a href="/post/{{ $posts[0]->slug }}" class="btn btn-primary">Read More</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4">
                        <div class="card mt-2">
                            <div class="position-absolute bg-dark px-2 py-1"><a
                                    href="/posts?category={{ $post->category->slug }}"
                                    class="text-decoration-none text-white fs-7">{{ $post->category->name }}</a></div>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid">
                            @else
                                <img src="https://picsum.photos/500/300" class="card-img-top"
                                    alt="{{ $post->category->name }}">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-body-secondary">
                                        By. <a href="/posts?author={{ $post->author->username }} "
                                            class="text-decoration-none">{{ $post->author->name }}</a>
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection

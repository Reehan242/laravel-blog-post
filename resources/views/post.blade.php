@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>
                <p>By. <a href="/posts?author={{ $post->author->username }}"
                        class="text-decoration-none">{{ $post->author->name }}</a> in
                    <a href="/posts?category={{ $post->category->slug }}"
                        class="text-decoration-none">{{ $post->category->name }}</a>
                </p>

                @if ($post->image)
                    <div style="max-height:300px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400" class="card-img-top img-fluid"
                        alt="{{ $post->category->name }}">
                @endif
                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>

                <div><a href="/posts" class="btn btn-primary mt-5">Back To Post</a></div>
            </div>
        </div>
    </div>
@endsection

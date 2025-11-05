@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
        @endif

        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-muted mb-3">{{ $post->created_at->format('F j, Y') }}</p>
            <p class="card-text">{{ $post->body }}</p>
        </div>

        <div class="card-footer bg-white d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit Post</a>
        </div>
    </div>
</div>
@endsection

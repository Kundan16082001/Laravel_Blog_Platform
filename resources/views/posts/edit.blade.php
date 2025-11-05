@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Post</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some issues with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 bg-light shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Body</label>
            <textarea name="body" class="form-control" rows="6" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Current Image</label><br>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-thumbnail mb-2" width="200">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back</a>
            <button type="submit" class="btn btn-primary px-4">Update Post</button>
        </div>
    </form>
</div>
@endsection

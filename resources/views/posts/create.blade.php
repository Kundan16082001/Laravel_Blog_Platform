@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Create New Post</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following issues:
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 bg-light shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter post title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Body</label>
            <textarea name="body" class="form-control" rows="6" placeholder="Write your content here..." required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back</a>
            <button type="submit" class="btn btn-success px-4">Publish Post</button>
        </div>
    </form>
</div>
@endsection

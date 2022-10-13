@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Edit a post</h3>
                    </div>
                    <div class="float-right">
                        <a href="{{ url('/dashboard') }}" class="btn btn-success">Go Back</a>
                    </div>
                </div>
                <div class="card-body shadow bg-white rounded">
                    <form action="{{ url('update-post/' . $post->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title here." value="{{ $post->title }}" name="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <textarea name="body" class="form-control mt-2" rows="4" placeholder="Body here.">{{ $post->body }}</textarea>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-success mt-2">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
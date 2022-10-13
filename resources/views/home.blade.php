@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        @if(session('success'))
                            <small class="text-success h3">{{ session('success') }}</small>
                        @endif
                    </div>
                    <div class="float-right">
                        <a href="{{ url('add-new-post') }}" class="btn btn-success">Add new</a>
                    </div>
                </div>
                @foreach($posts as $item)
                    <div class="card-body shadow bg-white rounded">
                        <h2>{{ $item->title }}</h2>
                        <p>{{ $item->body }}</p>
                        <div class="float-left">
                            Created By <b>{{ $item->user->name }}</b> {{ $item->created_at->diffForHumans() }}
                        </div>
                        <div class="float-right">
                            <a href="{{ url('read-details/' . $item->id) }}" class="btn btn-secondary">Read more</a>
                        </div>
                    </div>
                @endforeach

                <div class="card-footer">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
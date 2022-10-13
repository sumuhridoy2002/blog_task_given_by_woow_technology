@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('All Posts') }}
                    @if(session('success'))
                         <h3 class="text-success"> {{ session('success') }} </h3>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Author</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $item)
                                <tr>
                                    <th scope="row">{{ $posts->firstItem() + $loop->index }}</th>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $item->status == 'Active' ? 'success' : 'warning' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" onclick="alert('{{ $item->body }}')">View body</button>
                                        <a href="{{ url('update-post-status/' . $item->id) }}" class="btn btn-sm btn-{{ $item->status == 'Active' ? 'warning' : 'success' }}">
                                            {{ $item->status == 'Active' ? 'Inactive' : 'Active' }}
                                        </a>
                                        @if(auth()->id() == $item->user_id)
                                            <a href="{{ url('edit-post/' . $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        @endif
                                        <a href="{{ url('delete-post/' . $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

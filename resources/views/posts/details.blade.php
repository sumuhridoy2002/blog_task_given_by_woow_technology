@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade" id="replayModal" tabindex="-1" role="dialog" aria-labelledby="replayModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replayModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('store-replay') }}" method="post">
            @csrf
            <input type="hidden" name="comment_id" id="commentId">
            <textarea name="replay" class="form-control" required></textarea>
            <button type="submit" class="btn btn-sm btn-success mt-2">Submit replay</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                    @if(session('success'))
                        <small class="text-success">{{ session('success') }}</small>
                    @endif
                    </div>
                    <div class="float-right">
                        <a href="{{ url('/') }}" class="btn btn-success">Go Back</a>
                    </div>
                </div>
                <div class="card-body shadow bg-white rounded">
                    <h2>{{ $post->title }}</h2>
                    <div>{{ $post->body }}</div>                    
                </div>
                <div class="card-body shadow bg-white rounded">
                    <form action="{{ url('store-comment/' . $post->id) }}" method="post">
                        @csrf
                        <textarea name="comment" class="form-control" placeholder="Write a comment."></textarea>
                        <div>
                            @error('comment')
                                {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit comment</button>
                    </form>

                    <div class="accordion mt-3" id="accordion">
                        @foreach($post->comments as $comment)
                            <div class="card">
                                <div class="card-header" id="accordion{{ $comment->id }}">
                                    <small>
                                        {{ $comment->user->name }} <br>
                                        {{ date('F d, Y', strtotime($comment->created_at)) }}
                                    </small>
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $comment->id }}" aria-expanded="true" aria-controls="collapse{{ $comment->id }}">
                                            {{ $comment->comment }}
                                        </button>
                                    </h2>
                                    <button class="btn mt-1 btn-sm btn-info" data-toggle="modal" onclick="storeId('{{ $comment->id }}')" data-target="#replayModal">Replay</button>
                                    @if(auth()->user()->role == 'Admin' || auth()->id() == $comment->user_id || auth()->id == $comment->post->user_id)
                                        <a href="{{ url('delete-comment/' . $comment->id) }}" class="btn mt-1 btn-sm btn-danger">Delete</a>
                                    @endif
                                </div>
                                <div id="collapse{{ $comment->id }}" class="collapse" aria-labelledby="accordion{{ $comment->id }}" data-parent="#accordion">
                                    @foreach($comment->replays as $replay)
                                        <div class="card-body col-sm-10 m-auto">
                                            <small>
                                                {{ $replay->user->name }} <br>
                                                {{ date('F d, Y', strtotime($replay->created_at)) }}
                                            </small>
                                            <br>
                                            {{ $replay->replay }} <br>
                                            @if(auth()->user()->role == 'Admin' || auth()->id() == $replay->user_id || auth()->id == $replay->comment->post->user_id)
                                                <a href="{{ url('delete-replay/' . $replay->id) }}" class="btn mt-1 btn-sm btn-danger">Delete</a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function storeId(commentId) {
        document.getElementById('commentId').value = commentId
    }
</script>

@endsection
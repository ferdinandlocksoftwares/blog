    @extends('layouts.app')
    @section('title')
      @if($post)
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id ))
          <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->id)}}">Edit Post</a></button>
        @endif
      @else
        Page does not exist
      @endif
    @endsection
    @section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By {{ $post->user->name }}</a></p>
    @endsection
    @section('content')
    @if($post)
      <div>
        {!! $post->message !!}
      </div>    
      <div>
        <h2>Leave a comment</h2>
      </div>
      @if(Auth::guest())
        <p>Login to Comment</p>
      @else
        <div class="panel-body">
          <form method="post" action="/comment/add">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
              <textarea required="required" placeholder="Enter comment here" name = "comment" class="form-control"></textarea>
            </div>
            <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
          </form>
        </div>
      @endif
      <div>
        @if($comments)
        <ul style="list-style: none; padding: 0">
          @foreach($comments as $comment)
            <li class="panel-body">
              <div class="list-group">
                <div class="list-group-item">
                  <h3>{{ $comment->user->name }}</h3>
                  <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                </div>
                <div class="list-group-item">
                  <p>{{ $comment->comment }}</p>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        @endif
      </div>
    @else
    404 error
    @endif
    @endsection

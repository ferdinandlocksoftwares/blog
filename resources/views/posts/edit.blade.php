    @extends('layouts.app')
    @section('title')
    Edit Post
    @endsection
    @section('content')
    <form method="post" action='{{ url("/update") }}'>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
      <div class="form-group">
        <textarea name='message'class="form-control">
          {!! $post->message !!}
        </textarea>
      </div>
      <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
      <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
    </form>
    @endsection

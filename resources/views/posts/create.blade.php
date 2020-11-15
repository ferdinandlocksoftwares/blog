    @extends('layouts.app')

    @section('title')

    Add New Post

    @endsection

    @section('content')

    <form action="/new-post" method="post">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">

    <textarea name='message'class="form-control">{{ old('message') }}</textarea>

    </div>


    <input type="submit" name='save' class="btn btn-default" value = "Save" />

    </form>

    @endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Models\Post;



class PostController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('created_at','desc')->paginate(5);
		$title = 'Latest Posts';
		return view('home')->withPosts($posts)->withTitle($title);
	}

	public function create(Request $request)
	{
		return view('posts.create');
	}

	public function store(PostFormRequest $request)
	{
		$post = new Post();
		$post->message = $request->get('message');

		$post->user_id = $request->user()->id;
		$post->save();
		$message = 'Post saved successfully';
		return redirect('/')->withMessage($message);
	}

	public function show($id)
	{
		$post = Post::find($id);
		if(!$post)
		{
			return redirect('/')->withErrors('requested page not found');
		}
		$comments = $post->comments;
		return view('posts.show')->withPost($post)->withComments($comments);
	}

	public function edit(Request $request,$id)
	{
		$post = Post::find($id);
		if($post && ($request->user()->id == $post->user_id))
			return view('posts.edit')->with('post',$post);
		return redirect('/')->withErrors('you have not sufficient permissions');
	}

	public function update(Request $request)
	{
		$post_id = $request->input('post_id');
		$post = Post::find($post_id);
		if ($post && ($post->user_id == $request->user()->id)) {
			$post->message = $request->input('message');
			$message = 'Post updated successfully';
			$post->save();
			return redirect('/')->withMessage($message);
		} else {
			return redirect('/')->withErrors('you have not sufficient permissions');
		}
	}

	public function destroy(Request $request, $id)
	{
		//
		$post = Post::find($id);
		if($post && ($post->user_id == $request->user()->id ))
		{
			$post->delete();
			$data['message'] = 'Post deleted Successfully';
		}
		else 
		{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		return redirect('/')->with($data);
	}




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
	public function store(Request $request)
	{
		//on_post, from_user, body
		$input['user_id'] = $request->user()->id;
		$input['post_id'] = $request->post_id;
		$input['comment'] = $request->comment;
		$id = $request->input('id');
		// dd($request);
		Comment::create( $input );
		return redirect('show/'.$id)->with('message', 'Comment published');     
	}

}

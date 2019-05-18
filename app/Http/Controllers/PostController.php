<?php


namespace App\Http\Controllers;


use App\MunrfePost as Post;

class PostController
{
    public function index($id) {
        $post = Post::find($id);
        return view('post', [
            'post' => $post
        ]);
    }

}
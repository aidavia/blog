<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @return void
     */
    public function index()
    {
        return view('admin.posts');
    }

    /**
     * @param Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('admin.edit', compact('post'));
    }
}

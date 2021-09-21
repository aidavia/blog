<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostEditResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        //$this->middleware(['auth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return PostResource::collection(Post::latest()->get());
    }

    /**
     * @param Request $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => 'Untitled Post'
        ]);

        return new PostResource($post);
    }

    /**
     * @param Post $post
     * @return PostEditResource
     */
    public function edit(Post $post)
    {
        return new PostEditResource($post);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'teaser' => 'nullable',
            'body' => 'nullable',
            'slug' => 'required|string|unique:posts,slug,' . $post->id,
            'published' => 'boolean'
        ]);

        $post->update($request->only('title', 'teaser', 'body', 'published', 'slug'));
    }

    /**
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}

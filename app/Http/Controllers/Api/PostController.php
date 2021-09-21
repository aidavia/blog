<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return PostResource::collection(Post::latest()->wherePublished(true)->get());
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return PostResource
     */
    public function show(Post $post, Request $request)
    {
        return new PostResource($post);
    }
}

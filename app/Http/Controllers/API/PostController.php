<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Requests\PostDetail\PostDetailStoreRequest;
use App\Http\Requests\PostDetail\PostDetailUpdateRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts();

        return response()->json([
            'message' => 'Data Fetched Successfully',
            'posts' => $posts,
        ]);
    }

    public function publishedPosts()
    {
        $posts = $this->postService->getPublishedPosts();

        return response()->json([
            'message' => 'Data Fetched Successfully',
            'posts' => $posts,
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->postService->storePost($request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Post Created Successfully",
            'post' => $post,
        ], 200,);
    }

    public function edit(string $postId)
    {
        $post = $this->postService->getPostById($postId);

        return response()->json([
            'status' => 200,
            'message' => 'Post retrieved successfully',
            'post' => $post,
        ]);
    }

    public function update(string $postId, PostUpdateRequest $request)
    {
        $this->postService->updatePost($postId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Data Updated Successfully",
        ], 200);
    }

    public function destroy(string $postId)
    {
        $this->postService->deletePost($postId);

        return response()->json([
            'status' => 200,
            'message' => "Post Deleted Successfully",
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\PostDetailService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostDetail\PostDetailStoreRequest;
use App\Http\Requests\PostDetail\PostDetailUpdateRequest;

class PostDetailController extends Controller
{
    protected $postDetailService;

    public function __construct(PostDetailService $postDetailService)
    {
        $this->postDetailService = $postDetailService;
    }

    public function index(string $postId)
    {
        $postDetails = $this->postDetailService->getPostDetails($postId);

        return response()->json([
            'status' => 200,
            'message' => "Post Details Fetched Successfully",
            'postDetails' => $postDetails,
        ], 200);
    }

    public function store(string $postId, PostDetailStoreRequest $request)
    {
        $postDetail = $this->postDetailService->storePostDetails($postId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Post Detail Created Successfully",
            'post_detail' => $postDetail,
        ], 200);
    }

    public function update(string $postDetailId, PostDetailUpdateRequest $request)
    {
        $this->postDetailService->updatePostDetail($postDetailId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Post Detail Updated Successfully",
        ], 200);
    }

    public function destroy(string $postDetailId)
    {
        $this->postDetailService->deletePostDetail($postDetailId);

        return response()->json([
            'status' => 200,
            'message' => "Post Detail Deleted Successfully",
        ], 200);
    }

}

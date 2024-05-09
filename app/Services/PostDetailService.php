<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostDetail;
use Illuminate\Support\Facades\Storage;

/**
 * Class PostDetailService.
 */
class PostDetailService
{
    public function getPostDetails(string $postId)
    {
        $postDetail = PostDetail::with('post')->where('post_id', $postId)->orderBy('created_at', 'asc')->get();

        return $postDetail;
    }

    public function storePostDetails(string $postId, array $postDetailData)
    {
        $post = Post::findOrFail($postId);

        if (isset($postDetailData['type']) && $postDetailData['type'] === 'image') {
            $imagePath = $this->storeImage($postDetailData['content']);
            $postDetailData['content'] = $imagePath;
        }

        $postDetail = new PostDetail($postDetailData);
        $post->post_details()->save($postDetail);

        return $postDetail;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientoriginalExtension();
        $imagePath = $image->storeAs('images/postdetails', $imageName, 'public');

        return $imagePath;
    }

    public function updatePostDetail(string $postDetailId, array $data)
    {
        $postDetail = PostDetail::findOrFail($postDetailId);

        if (isset($postDetail['content']) && $postDetail['type'] === "image") {
            $this->updateImagePostDetail($postDetail, $data['content']);
        } else {
            $postDetail->update($data);
        }

        return $postDetail;
    }

    private function updateImagePostDetail(PostDetail $postDetail, $content)
    {
        $imageName = time() . '.' . $content->getClientOriginalExtension();
        $imagePath = $content->storeAs('public/images/postdetails', $imageName);

        if ($postDetail->content) {
            Storage::delete('public/' . $postDetail->content);
        }

        $postDetail->content = str_replace('public/', '', $imagePath);
        $postDetail->save();
    }

    public function deletePostDetail(string $postDetailId)
    {
        $postDetail = PostDetail::findOrFail($postDetailId);

        if ($postDetail->type === "image") {
            $this->deletePostDetailImage($postDetail->content);
            $postDetail->delete();
        } else {
            $postDetail->delete();
        }
    }

    private function deletePostDetailImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath);
        }
    }
}

<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Class PostService.
 */
class PostService
{
    public function getPosts()
    {
        $posts = Post::with('post_details')->orderBy('created_at', 'desc')->get();

        return $posts;
    }

    public function getPublishedPosts()
    {
        $posts = Post::where('status', '=', 'publish')->with('post_details')->orderBy('created_at', 'desc')->get();

        return $posts;
    }

    public function storePost(array $postData)
    {
        if (isset($postData['image'])) {
            $postData['image'] = $this->storeImage($postData['image']);
        }

        $post = Post::create($postData);

        return $post;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientoriginalExtension();
        $imagePath = $image->storeAs('images/posts', $imageName, 'public');

        return $imagePath;
    }

    public function getPostById(string $postId)
    {
        $post = Post::with('post_details')->findOrFail($postId);

        return $post;
    }

    public function updatePost(string $postId, array $data)
    {
        $post = Post::findOrFail($postId);

        $post->title = $data['title'] ?? $post->title;
        $post->post_date = $data['post_date'] ?? $post->post_date;
        $post->author = $data['author'] ?? $post->author;
        $post->status = $data['status'] ?? $post->status;

        if (isset($data['image'])) {
            $this->updateImage($post, $data['image']);
        }

        $post->save();

        return $post;
    }

    private function updateImage(Post $post, $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images/posts', $imageName);

        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->image = str_replace('public/', '', $imagePath);
    }

    public function deletePost(string $postId)
    {
        $post = Post::findOrFail($postId);

        $postDetails = $post->postDetails;

        if ($postDetails) {
            foreach ($postDetails as $detail) {
                $detail->delete();
            }
        }

        $this->deletePostImage($post->image);

        $post->delete();

        return $post;
    }

    private function deletePostImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath);
        }
    }
}

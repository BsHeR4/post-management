<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{

    /**
     * Get paginated posts with applied filters
     *
     * This function retrieves a paginated list of posts from the Post model
     * applying filters based on the request data parameter
     * The filters include:
     * - title
     * - recordes per page
     *
     * The function returns the filtered results paginated with 10 items per page
     *
     * @param array $filters The incoming filters containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered posts
     */
    public function getAll(array $filters = [])
    {
        $query = Post::query();

        $perPage = $filters['per_page'] ?? 10;

        $query->when(isset($filters['title']), function ($query) use ($filters) {
            return $query->title($filters['title']);
        });

        return  $query->paginate($perPage);
    }

    /**
     * to get one post using slug
     * 
     * @param string get post by slug
     */
    public function get(string $slug)
    {
        return Post::where('slug', $slug)->firstOrFail();
    }

    /**
     * For store a new post
     * 
     * @param array $data To store the post
     */
    public function store(array $data)
    {
        $post = Post::create($data);
        return $post;
    }

    /**
     * For update a post
     * 
     * @param array $data To Update the post
     * @param string $slug To know which post will be updated using slug
     */
    public function update(array $data, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->update($data);
        return $post;
    }

    /**
     *  Delete the specified post
     * 
     *  @param string $slug To know which post will be deleted using slug
     *  @return bool|null True if the post was deleted, false otherwise
     */
    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return $post->delete();
    }
}

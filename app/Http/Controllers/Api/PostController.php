<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterPostsRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Service to handle post-related logic 
     * and separating it from the controller
     * 
     * @var PostServiceInterface
     */
    protected $postService;

    /**
     * PostController constructor
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        // Inject the PostService to handle user-related logic
        $this->postService = $postService;
    }
    /**
     * Display a listing of posts
     * 
     * @param FilterPostsRequest $request The request object containing filter data 
     */
    public function index(FilterPostsRequest $request)
    {
        try {
            $filters = $request->validated();
            $posts = $this->postService->getAll($filters);
            return $this->successResponse(
                'success',
                PostResource::collection($posts)
            );
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred while fetching posts');
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StorePostRequest $request The request object containing validated data 
     */
    public function store(StorePostRequest $request)
    {
        try {
            $data = $request->validated();
            $post = $this->postService->store($data);
            return $this->successResponse('success', new PostResource($post));
        } catch (\Throwable $th) {
            return $this->errorResponse('Could not create a post, Please try again');
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param string $slug to show post using slug in url
     * like: http://127.0.0.1:8000/api/posts/test-post-slug
     */
    public function show(string $slug)
    {
        try {
            $post = $this->postService->get($slug);
            return $this->successResponse('success', new PostResource($post));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found');
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred while fetching post');
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdatePostRequest $request The request object containing validated data
     * @param string $slug to update post using slug in url
     * like: http://127.0.0.1:8000/api/posts/test-post-slug
     */
    public function update(UpdatePostRequest $request, string $slug)
    {
        try {
            $data = $request->validated();
            $post = $this->postService->update($data, $slug);

            return $this->successResponse('success', new PostResource($post));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found to update');
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred while updating the post');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $slug to delete post using slug in url
     * like: http://127.0.0.1:8000/api/posts/test-post-slug
     */
    public function destroy(string $slug)
    {
        try {
            $this->postService->destroy($slug);
            return $this->successResponse('success');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Post not found to delete');
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred while deleting the post');
        }
    }
}

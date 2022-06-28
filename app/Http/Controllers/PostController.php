<?php

namespace App\Http\Controllers;

use App\Dto\CreatePostDto;
use App\Dto\GetPostsDto;
use App\Dto\PaginateDto;
use App\Helpers\JResponse;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\Post\GetAllPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function getAll(GetAllPostRequest $request)
    {
        $dto = new GetPostsDto($request->validated());
        $posts = $this->postService->getAll($dto);
        return JResponse::success($posts);
    }

    public function store(StorePostRequest $request)
    {
        $dto = new CreatePostDto($request->validated());
        $post = $this->postService->createPost(auth()->user(), $dto);
        return JResponse::create($post);
    }

    public function like(Post $post)
    {
        $this->postService->setOrRemoveLike($post, auth()->user());
        return JResponse::success();
    }

    public function getLikes(Post $post, PaginateRequest $request)
    {
        $dto = new PaginateDto($request->validated());
        $posts = $this->postService->getPostLikes($post, $dto);
        return JResponse::success($posts);
    }

    public function getCategories()
    {
        return JResponse::success(Category::all());
    }
}

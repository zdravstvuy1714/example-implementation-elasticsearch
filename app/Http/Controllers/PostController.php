<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\Post\IndexPostRequest;
use App\Services\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(IndexPostRequest $request): JsonResponse
    {
        $posts = $this->postService->index($request->validated());

        return responder()->success($posts, new PostTransformer())->respond();
    }
}

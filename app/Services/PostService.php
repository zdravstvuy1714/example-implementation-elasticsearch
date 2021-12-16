<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    private PaginationService $paginationService;
    private PostRepository $postRepository;

    public function __construct(PaginationService $paginationService, PostRepository $postRepository)
    {
        $this->paginationService = $paginationService;
        $this->postRepository = $postRepository;
    }

    public function index(array $data): LengthAwarePaginator
    {
        $posts = Post::query();

        if (array_key_exists('search', $data)) {
            $posts = $this->postRepository->search($data['search']);
        }

        return $this->paginationService->paginate($posts, $data);
    }
}

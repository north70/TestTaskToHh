<?php

namespace App\Services;

use App\Dto\CreatePostDto;
use App\Dto\GetPostsDto;
use App\Dto\PaginateDto;
use App\Helpers\PaginateHelper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function createPost(User $user, CreatePostDto $dto): Post
    {
        $params = array_merge(['author_id' => $user->id], $dto->getParams());
        return Post::create($params);

    }

    public function getAll(GetPostsDto $dto)
    {
        $posts = Post::query()
            ->join('categories','posts.category_id','=', 'categories.id')
            ->select([
                'posts.id',
                'title',
                'author_id',
                'categories.name as category',
                'posts.created_at as published_at'
            ])
            ->orderByDesc('created_at');

        if (isset($dto->categories)) {
            $posts->whereIn('category_id',$dto->categories);
        }

        return PaginateHelper::paginate($posts, $dto);
    }

    public function setOrRemoveLike(Post $post, User $user)
    {
        if ($post->like()->wherePivot('user_id','=',$user->id)->exists()) {
            DB::table('post_likes')
                ->where('user_id','=', $user->id)
                ->where('post_id','=', $post->id)
                ->delete();
        } else {
            $post->like()->attach($user->id);
        }
    }

    public function getPostLikes(Post $post, PaginateDto $dto)
    {
        $likes = DB::table('post_likes')
            ->join('users','post_likes.user_id','=','users.id')
            ->select([
                'users.id',
                'users.name'
            ])
            ->where('post_id','=', $post->id);

        return PaginateHelper::paginate($likes, $dto);
    }
}

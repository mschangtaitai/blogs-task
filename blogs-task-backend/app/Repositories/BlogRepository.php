<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\User;
use App\Repositories\BlogRepositoryInterface;
use Carbon\Carbon;

class BlogRepository implements BlogRepositoryInterface {
    public function get($id) {
        $blog =  Blog::with('user')->findOrFail($id);
        $comments = [];
        foreach ($blog->comments as $comment) {
            $commentComments = [];
            $user = User::findOrFail($comment->user_id);
            $comment->setAttribute('user', $user->first_name . ' ' . $user->last_name);
            foreach ($comment->comments as $commentComment) {
                $user = User::findOrFail($commentComment->user_id);
                $commentComment->setAttribute('user', $user->first_name . ' ' . $user->last_name);
                array_push($commentComments, $commentComment);
            }
            $comment->setAttribute('comments', $comment->commentComments);
            array_push($comments, $comment);
        }
        $blog->setAttribute('comments', $blog->comments);
        return $blog;
    }
    public function all($userId) {
        $user_blogs = Blog::with('user')->where('user_id', $userId)->paginate(4);

        return $user_blogs;
    }

    public function feed() {
        $blogs = Blog::with('user')->whereDate('available_at', '<', Carbon::now())->orWhereNull('available_at')->paginate(4);
        return $blogs;
    }

    public function store($payload) {
        $Blog = new Blog();
        $Blog->user_id = $payload["userId"];
        $Blog->title = $payload["title"];
        $Blog->content = $payload["content"];
        $Blog->hide_comments = $payload["hideComments"];
        $Blog->available_at = $payload["availableAt"];

        $Blog->save();
        return $Blog;
    }

    public function update($payload) {
        $blog = Blog::where('id', $payload->userId)->first();
        if ($blog->user_id == $payload->userId) {
            $blog->title = $payload->title;
            $blog->content = $payload->content;
            $blog->hide_comments = $payload->hideComments;
            $blog->save();
            return $blog;
        } else {
            return 'You are not the owner of this blog';
        }
    }

    public function delete($id) {
        $blog = Blog::where('id', $id)->delete();
        return $blog;
    }

    public function deletedBlogs() {
        $blogs = Blog::with('user')->onlyTrashed()->paginate(4);
        return $blogs;
    }
}

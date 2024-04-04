<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\User;
use App\Repositories\BlogRepositoryInterface;
use Carbon\Carbon;

class BlogRepository implements BlogRepositoryInterface {
    public function get($id) {
        $blog =  Blog::with('user')->findOrFail($id);
        $comments = array();
        foreach ($blog->comments as $comment) {
            $user = User::findOrFail($comment->user_id);
            $comment->setAttribute('user', $user->first_name . ' ' . $user->last_name);
            array_push($comments, $comment);
        }
        $blog->setAttribute('comments', $blog->comments);
        return $blog;
    }
    public function all($user_id) {
        $user_blogs = Blog::with('user')->where('user_id', $user_id)->paginate(4);

        return $user_blogs;
    }

    public function feed() {
        $blogs = Blog::with('user')->whereDate('available_at', '<', Carbon::now())->orWhereNull('available_at')->paginate(4);
        return $blogs;
    }

    public function store($payload) {
        $Blog = new Blog();
        $Blog->user_id = $payload["user_id"];
        $Blog->title = $payload["title"];
        $Blog->content = $payload["content"];
        $Blog->hide_comments = $payload["hide_comments"];
        $Blog->available_at = $payload["available_at"];

        $Blog->save();
        return $Blog;
    }

    public function update($payload) {
        $blog = Blog::where('id', $payload->user_id)->first();
        if ($blog->user_id == $payload->user_id) {
            $blog->title = $payload->title;
            $blog->content = $payload->content;
            $blog->hide_comments = $payload->hide_comments;
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
}

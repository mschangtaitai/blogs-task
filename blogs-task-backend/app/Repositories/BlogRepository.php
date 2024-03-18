<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogRepository {
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
        $user_blogs = Blog::with('user')->where('user_id', $user_id)->first();

        return $user_blogs->comments;
    }

    public function feed() {
        $blogs = Blog::with('user')->paginate(4);
        return $blogs;
    }

    public function store($payload) {
        return Blog::create([
            'user_id' => $payload->user_id,
            'title' => $payload->title,
            'content' => $payload->content,
            'hide_comments' => $payload->hide_comments,
            'available_at' => $payload->available_at,
        ]);
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
}

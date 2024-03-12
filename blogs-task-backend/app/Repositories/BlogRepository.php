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
    public function all(Request $request) {
        $user_id = $request->user()->id;
        $user_blogs = Blog::with('user')->where('user_id', $user_id)->first();

        return $user_blogs->comments;
    }

    public function feed(Request $request) {
        $blogs = Blog::with('user')->paginate(4);
        return $blogs;
    }

    public function store(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hide_comments' => 'required|boolean',
        ]);

        return Blog::create([
            'user_id' => $request->user()->id,
            'title' => request('title'),
            'content' => request('content'),
            'hide_comments' => request('hide_comments'),
            'available_at' => request('available_at'),
        ]);
    }

    public function update(Request $request) {
        $blog = Blog::where('id', $request->id)->first();
        if ($blog->user_id == $request->user()->id) {
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->hide_comments = $request->hide_comments;
            $blog->save();
            return $blog;
        } else {
            return 'You are not the owner of this blog';
        }
    }
}

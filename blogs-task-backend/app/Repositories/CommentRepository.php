<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository {
    public function get($id) {
        return Comment::findOrFail($id);
    }
    public function all(Request $request) {
        $user_id = $request->user()->id;
        $user_comments = Comment::with('user')->where('user_id', $user_id)->get();

        return $user_comments;
    }

    public function store(Request $request) {
        request()->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);

        $type = request('commentable_type') == 'Blog' ? Blog::class : Comment::class;

        return Comment::create([
            'user_id' => $request->user()->id,
            'commentable_type' => $type,
            'commentable_id' => request('commentable_id'),
            'comment' => request('comment'),
        ]);
    }

    public function delete($id) {
        $comment = Comment::where('id', $id)->delete();
        return $comment;
    }
}

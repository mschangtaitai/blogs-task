<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository {
    public function get($id) {
        return Comment::findOrFail($id);
    }
    public function all(Request $request) {
        $user_id = $request->user()->id;
        $user_comments = Comment::where('user_id', $user_id)->get();

        return $user_comments;
    }

    public function store(Request $request) {
        request()->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);

        return Comment::create([
            'user_id' => $request->user()->id,
            'commentable_type' => request('commentable_type'),
            'commentable_id' => request('commentable_id'),
            'comment' => request('comment'),
        ]);
    }
}

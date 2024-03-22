<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository implements CommentRepositoryInterface {
    public function get($id) {
        return Comment::findOrFail($id);
    }
    public function all($user_id) {
        $user_comments = Comment::with('user')->where('user_id', $user_id)->get();

        return $user_comments;
    }

    public function store($payload) {
        return Comment::create($payload);
    }

    public function delete($id) {
        $comment = Comment::where('id', $id)->delete();
        return $comment;
    }
}

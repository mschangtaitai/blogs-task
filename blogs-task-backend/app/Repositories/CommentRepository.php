<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository implements CommentRepositoryInterface {
    public function get($id) {
        return Comment::findOrFail($id);
    }
    public function all($userId) {
        $userComments = Comment::with('user')->where('user_id', $userId)->get();

        return $userComments;
    }

    public function store($payload) {
        return Comment::create($payload);
    }

    public function delete($id) {
        $comment = Comment::where('id', $id)->delete();
        return $comment;
    }
}

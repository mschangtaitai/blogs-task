<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller {
    //
    public function __construct(
        protected CommentRepository $commentRepository,
    ) {
    }

    public function show() {
        return $this->commentRepository->get(1);
    }

    public function index(Request $request) {
        $user_id = $request->user()->id;
        return $this->commentRepository->all($user_id);
    }

    public function store(Request $request) {
        request()->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);

        $payload = array(
            'user_id' => $request->user()->id,
            'commentable_type' => request('commentable_type') == 'Blog' ? Blog::class : Comment::class,
            'commentable_id' => request('commentable_id'),
            'comment' => request('comment'),
        );

        return $this->commentRepository->store($payload);
    }

    public function delete($id) {
        return $this->commentRepository->delete($id);
    }
}

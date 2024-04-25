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
        $userId = $request->user()->id;
        return $this->commentRepository->all($userId);
    }

    public function store(Request $request) {
        request()->validate([
            'commentableType' => 'required',
            'commentableId' => 'required',
            'comment' => 'required',
        ]);

        $payload = [
            'user_id' => $request->user()->id,
            'commentable_type' => request('commentableType') == 'Blog' ? Blog::class : Comment::class,
            'commentable_id' => request('commentableId'),
            'comment' => request('comment'),
        ];

        return $this->commentRepository->store($payload);
    }

    public function delete($id) {
        return $this->commentRepository->delete($id);
    }
}

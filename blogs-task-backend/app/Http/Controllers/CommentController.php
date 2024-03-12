<?php

namespace App\Http\Controllers;

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
        return $this->commentRepository->all($request);
    }

    public function store(Request $request) {
        return $this->commentRepository->store($request);
    }

    public function delete($id) {
        return $this->commentRepository->delete($id);
    }
}

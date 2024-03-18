<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use stdClass;

class BlogController extends Controller {
    //
    public function __construct(
        protected BlogRepository $blogRepository,
    ) {
    }

    public function show($id) {
        return $this->blogRepository->get($id);
    }

    public function index(Request $request) {
        $user_id = $request->user()->id;
        return $this->blogRepository->all($user_id);
    }

    public function store(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hide_comments' => 'required|boolean',
        ]);

        $payload = new stdClass();
        $payload->user_id = $request->user()->id;
        $payload->title = $request->title;
        $payload->content = $request->content;
        $payload->hide_comments = $request->hide_comments;
        $payload->available_at = $request->available_at;

        return $this->blogRepository->store($payload);
    }

    public function update(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hide_comments' => 'required|boolean',
        ]);

        $payload = new stdClass();
        $payload->user_id = $request->user()->id;
        $payload->title = $request->title;
        $payload->content = $request->content;
        $payload->hide_comments = $request->hide_comments;
        $payload->available_at = $request->available_at;

        return $this->blogRepository->update($payload);
    }

    public function feed() {
        return $this->blogRepository->feed();
    }
}

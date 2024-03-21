<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\Request;
use stdClass;

class BlogController extends Controller {
    //
    protected $blog;
    public function __construct(BlogRepository $blog) {
        $this->blog = $blog;
    }

    public function show($id) {
        return $this->blog->get($id);
    }

    public function index($user_id) {
        $user_id = $user_id;
        return $this->blog->all($user_id);
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

        return $this->blog->store($payload);
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

        return $this->blog->update($payload);
    }

    public function feed() {
        return $this->blog->feed();
    }
}

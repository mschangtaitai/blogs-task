<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $payload = array(
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'hide_comments' => $request->hide_comments,
            'available_at' => $request->available_at,
        );

        return $this->blog->store($payload);
    }

    public function update(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hide_comments' => 'required|boolean',
        ]);

        $payload = array(
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'hide_comments' => $request->hide_comments,
            'available_at' => $request->available_at,
        );

        return $this->blog->update($payload);
    }

    public function feed() {
        return $this->blog->feed();
    }
}

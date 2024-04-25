<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTimeImmutable;
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

    public function index($userId) {
        return $this->blog->all($userId);
    }

    public function store(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hideComments' => 'required|boolean',
            'availableAt' => 'required',
        ]);

        $payload = [
            'userId' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'hideComments' => $request->hideComments,
            'availableAt' => $request->availableAt,
        ];

        return $this->blog->store($payload);
    }

    public function update(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hideComments' => 'required|boolean',
        ]);

        $payload = [
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'hideComments' => $request->hideComments,
            'availableAt' => $request->availableAt,
        ];

        return $this->blog->update($payload);
    }

    public function feed() {
        return $this->blog->feed();
    }

    public function delete($id) {
        return $this->blog->delete($id);
    }

    public function deletedBlogs() {
        return $this->blog->deletedBlogs();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTimeImmutable;
use stdClass;
use App\Classes\CreateBlogBodyRequest;

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

        $bodyRequest = new CreateBlogBodyRequest();
        $bodyRequest->set_userId($request->user()->id);
        $bodyRequest->set_title($request->title);
        $bodyRequest->set_content($request->content);
        $bodyRequest->set_hideComments($request->hideComments);
        $bodyRequest->set_availableAt($request->availableAt);

        return $this->blog->store($bodyRequest);
    }

    public function update(Request $request) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'hideComments' => 'required|boolean',
        ]);

        $bodyRequest = new CreateBlogBodyRequest();
        $bodyRequest->set_userId($request->user()->id);
        $bodyRequest->set_title($request->title);
        $bodyRequest->set_content($request->content);
        $bodyRequest->set_hideComments($request->hideComments);
        $bodyRequest->set_availableAt($request->availableAt);

        return $this->blog->update($bodyRequest);
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

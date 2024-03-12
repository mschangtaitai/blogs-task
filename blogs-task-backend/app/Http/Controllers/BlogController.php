<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
        return $this->blogRepository->all($request);
    }

    public function store(Request $request) {
        return $this->blogRepository->store($request);
    }

    public function update(Request $request) {
        return $this->blogRepository->update($request);
    }

    public function feed(Request $request) {
        return $this->blogRepository->feed($request);
    }
}

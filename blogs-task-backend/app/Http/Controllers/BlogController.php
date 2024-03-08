<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends Controller {
    //
    public function __construct(
        protected BlogRepository $blogRepository,
    ) {
    }

    public function show() {
        return $this->blogRepository->get(1);
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
}

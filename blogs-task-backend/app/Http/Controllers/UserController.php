<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller {
    //
    public function __construct(
        protected UserRepository $userRepository,
    ) {
    }

    public function show() {
        return $this->userRepository->get(1);
    }

    public function index() {
        return $this->userRepository->all();
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }
}

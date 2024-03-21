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

    public function show($id) {
        return $this->userRepository->get($id);
    }

    public function index() {
        return $this->userRepository->all();
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }
}

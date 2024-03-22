<?php

namespace App\Repositories;

interface CommentRepositoryInterface {
    public function get($id);

    public function all($user_id);

    public function store($payload);

    public function delete($id);
}

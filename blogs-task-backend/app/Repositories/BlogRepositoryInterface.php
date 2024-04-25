<?php

namespace App\Repositories;

interface BlogRepositoryInterface {
    public function get($id);

    public function all($user_id);

    public function feed();

    public function store($payload);

    public function update($payload);

    public function delete($id);

    public function deletedBlogs();
}

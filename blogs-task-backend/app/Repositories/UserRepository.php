<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function get($id) {
        return User::findOrFail($id);
    }
    public function all() {
        return User::all();
    }
}

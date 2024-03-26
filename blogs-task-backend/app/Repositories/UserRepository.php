<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function get($id) {
        return User::findOrFail($id);
    }
    public function all() {
        error_log('Schedule!');
        return User::all();
    }

    public function delete($id) {
        $user = User::where('id', $id)->delete();
        return $user;
    }
}

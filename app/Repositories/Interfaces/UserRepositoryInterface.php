<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function checkPassword($email,$password);

    public function updateToken($userId) : Model;

    public function removeToken($request) : Bool;
}

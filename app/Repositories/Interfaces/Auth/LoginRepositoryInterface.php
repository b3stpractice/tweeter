<?php

namespace App\Repositories\Interfaces\Auth;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface LoginRepositoryInterface extends UserRepositoryInterface
{
    public function checkPassword($email,$password);
    public function updateToken($userId) : Model;
}

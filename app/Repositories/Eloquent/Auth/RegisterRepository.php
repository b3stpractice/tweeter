<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\Auth\RegisterRepositoryInterface;

class RegisterRepository extends UserRepository implements RegisterRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }


}

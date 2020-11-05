<?php

namespace App\Providers;

use App\Repositories\Eloquent\Auth\LoginRepository;
use App\Repositories\Eloquent\Auth\LogoutRepository;
use App\Repositories\Eloquent\Auth\RegisterRepository;
use App\Repositories\Interfaces\UserRepositoryInterface\UserRepositoryInterface;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\Auth\LoginRepositoryInterface;
use App\Repositories\Interfaces\Auth\LogoutRepositoryInterface;
use App\Repositories\Interfaces\Auth\RegisterRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
       $this->app->bind(LoginRepositoryInterface::class,LoginRepository::class);
       $this->app->bind(RegisterRepositoryInterface::class,RegisterRepository::class);
       $this->app->bind(LogoutRepositoryInterface::class,LogoutRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

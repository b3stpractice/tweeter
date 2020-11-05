<?php
namespace App\Services\Auth;

use App\Repositories\Eloquent\Auth\LoginRepository;
use App\Lib\ResponseTemplate;
use Illuminate\Http\Request;

class LoginService extends ResponseTemplate{

    protected $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(Request $request)
    {
        if($user = $this->loginRepository->checkPassword($request->phone,$request->password))
        {
            $this->setData($this->loginRepository->updateToken($user));
        }
        else
        {
            $this->setErrors(['email' => ['موبایل یا پسورد اشتباه است']]);
            $this->setStatus(401);
        }

        return $this->response();
    }
}

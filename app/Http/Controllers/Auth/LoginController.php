<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    //valida que el usuario sea activo en el sistema
    protected function validateLogin(Request $request) {
        $this->validate($request, [ $this->username() =>
            'required|exists:users,' . $this->username() . ',status_id,1', 'password' => 'required', ], [ $this->username() . '.exists' => 'Las credenciales son invalidas o el usuario ha sido desactivado.' ]);
    }

    public function logout(){
        $this->guard()->logout();

        request()->session()->invalidate();
        return redirect('/login');

    }
}

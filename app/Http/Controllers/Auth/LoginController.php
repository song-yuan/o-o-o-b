<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Repositories\AdminRepository;
use Auth;
=======
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
>>>>>>> 40d71934e8efdd692ca4a39832f230f02c0c32be

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function index() {
<<<<<<< HEAD
        return view('auth.login');
    }
    
    public function login(Request $request) {        
        $credentials = $request->only('email', 'password');
        $adminRep = new AdminRepository();
		$validator = $adminRep->validator($credentials);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $admin = $adminRep->findBy('email', $credentials['email']);
		if ($admin && $adminRep->checkPwd($credentials['password'], $admin->password)) {
            Auth::login($admin);
            return redirect(url('/'));
		} else {
            $validator->errors()->add('email', trans('auth.user_error'));
        }
        return redirect()->back()->withInput()->withErrors($validator);
=======
        
        return view('auth.login');
    }
    
    public function login(Request $request) {
        $userName = $request->all('user_name');
        $password = $request->all('password');
        
        
        
        var_dump($data);exit;
>>>>>>> 40d71934e8efdd692ca4a39832f230f02c0c32be
    }
    
}

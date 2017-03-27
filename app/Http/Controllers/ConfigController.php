<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Excel;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
    }
    
    public function index(Request $request) {
        $userRep = new UserRepository();
        $mobile = $request->input('mobile', null);
        
        $users = $userRep->lists($mobile);
        
        return view('users/index', array(
            'users' => $users,
            'mobile' => $mobile
        ));
    }
}

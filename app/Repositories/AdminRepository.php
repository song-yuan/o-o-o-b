<?php
namespace App\Repositories;
<<<<<<< HEAD

use App\Models\Admin;
use Validator;

class AdminRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new Admin();
	}
    
    public $rule = [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];
    /**
     * 验证
     * @param array $data
     * @return type
     */
	public function validator(array $data)
	{
		return Validator::make($data, $this->rule, trans('auth'));
	}
    
    public function checkPwd($input, $password) {
        return hashPwd($input) === $password ? true : false ;
    }
}
=======
>>>>>>> 40d71934e8efdd692ca4a39832f230f02c0c32be

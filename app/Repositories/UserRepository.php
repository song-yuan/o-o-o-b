<?php
namespace App\Repositories;

use App\Models\User;
use Validator;

class UserRepository extends BaseRepository{
    public function __construct() {
		$this->model = new User();
	}
    
    public $rule = [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];
    
    public function lists($mobile = '', $pageSize = 10) {
        if($mobile) {
            return $this->model->where('mobile', $mobile)->orderBy('user_id', 'desc')->paginate($pageSize);
        }
        return $this->model->orderBy('user_id', 'desc')->paginate($pageSize);
    }
}
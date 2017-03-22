<?php
namespace App\Repositories;
use App\Models\Role;
use Validator;

class RoleRepository extends BaseRepository{
    public function __construct() {
		$this->model = new Role();
	}
    
    public $rule = [
        'name' => 'required|string|min:2',
        'display_name' => 'required|string|min:2',
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
    
    public function getList() {
        
    }
}

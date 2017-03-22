<?php
namespace App\Repositories;
use App\Models\Permission;
use Validator;

class PermissionRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new Permission();
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
    
}

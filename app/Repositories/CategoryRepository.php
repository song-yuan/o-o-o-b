<?php
namespace App\Repositories;

use App\Models\Category;
use Validator;
use DB;

class CategoryRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new Category();
	}
    
    public $rule = [
        'name' => 'required|between:2,20',
        'alias' => 'required|string|between:2,20'
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('category'));
	}
}
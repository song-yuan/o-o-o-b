<?php
namespace App\Repositories;

use App\Models\Partner;
use Validator;
use DB;

class PartnerRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new Partner();
	}
    
    public $rule = [
        'partner_name' => 'required|between:2,20', 
        'logo' => 'required|image',
        'home_page' => 'required|url'
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('partner'));
	}
    
}
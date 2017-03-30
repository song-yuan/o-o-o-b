<?php
namespace App\Repositories;
use App\Models\BillLog;
use Validator;

class BillLogRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new BillLog();
	}
    
    public $rule = [
        'bill_sn' => 'required|between:5,20',
        'date_time' => 'date',
//        'location' => 'required|string',
//        'description' => 'required|string|max:255',
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('bills'));
	}
    
}
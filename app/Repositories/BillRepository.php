<?php
namespace App\Repositories;

use App\Models\Bill;
use App\Models\BillLog;
use Validator;

class BillRepository extends BaseRepository{
    public function __construct()
	{
		$this->model = new Bill();
	}
    
    public $rule = [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('bills'));
	}
    
    
    public function lists($billSn = '', $pageSize = 10) {
        if($billSn) {
            return $this->model->where('bill_sn', $billSn)->orderBy('bill_id', 'desc')->paginate($pageSize);
        }
        return $this->model->orderBy('bill_id', 'desc')->paginate($pageSize);
    }
}
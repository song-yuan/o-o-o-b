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
        'remark' => 'required|between:4,50',
        'arrived_at' => 'date',
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('bills'));
	}
    
    public function lists($billSn) {
        return $this->model->where('bill_sn', '=', $billSn)->orderBy('log_id', 'desc')->get();
    }
    
}
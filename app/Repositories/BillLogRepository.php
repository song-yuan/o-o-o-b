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
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];
    
    public function lists($billSn, $pageSize = 10) {
        return $this->model->where('bill_sn', '=', $billSn)->orderBy('log_id', 'desc')->get();
    }
    
}
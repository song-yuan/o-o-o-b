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
        'bill_sn' => 'required|between:5,20',
        'partner_id' => 'required|integer',
        'sender_name' => 'string|between:2,20',
        'sender_address' => 'string|between:6,50',
        'receiver_name' => 'string|between:2,20',
        'receiver_address' => 'string|between:6,50',

        'sended_at' => 'date',
        'signed_at' => 'date',
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
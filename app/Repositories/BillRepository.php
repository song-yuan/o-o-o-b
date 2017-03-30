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
        'partner_id' => 'required|integer|min:1',
        'sender_name' => 'string|between:2,20',
        'sender_address' => 'string|between:2,50',
        'receiver_name' => 'string|between:2,20',
        'receiver_address' => 'string|between:2,50',

        'sended_at' => 'date',
        'signed_at' => 'date',
    ];
    
	public function validator(array $data) {
		return Validator::make($data, $this->rule, trans('bills'));
	}
    
    public function getList($billSn) {
        if($billSn) {
            return parent::paginate(['bill_sn', $billSn], ['bill_id', 'desc']);
        }
        return parent::paginate([], ['bill_id', 'desc']);
    }
    
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BillLog extends Model {
    
    protected $table = 'bills_log';
    protected $primaryKey = 'log_id';
    protected $fillable = array(
        'bill_sn', 
        'remark'
    );
    
}
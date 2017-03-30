<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BillLog extends Model {
    
    protected $table = 'bills_log';
    protected $primaryKey = 'log_id';
    public $timestamps = false;
    protected $fillable = array(
        'bill_sn',
        'date',
        'time',
        'location',
        'description'
    );
    
}
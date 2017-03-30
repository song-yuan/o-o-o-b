<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bill extends Model {
    
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';
    protected $fillable = array(
        'bill_sn',
        'partner_id',
        'sender_name', 
        'sender_address', 
        'receiver_name',
        'receiver_address'
    );

    public function partner() {
        return $this->hasOne('App\Models\Partner','partner_id','partner_id');
    }
}
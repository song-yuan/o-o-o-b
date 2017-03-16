<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bill extends Model {
    
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';
    protected $fillable = array(
        'bill_sn', 
        'sender_name', 
        'sender_address', 
        'receiver_name',
        'receiver_address',
        'receiver_address'
    );

    
}
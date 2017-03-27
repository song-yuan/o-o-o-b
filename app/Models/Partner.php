<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Partner extends Model {
    
    protected $table = 'partners';
    protected $primaryKey = 'partner_id';
    protected $fillable = array(
        'partner_name', 
        'logo',
        'home_page',
        'description'
    );
    
}
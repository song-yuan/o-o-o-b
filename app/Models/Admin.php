<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['user_name', 'email', 'mobile', 'password'];

    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps = false;
}

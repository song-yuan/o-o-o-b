<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['user_name', 'email', 'mobile', 'password'];

    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps = false;
}

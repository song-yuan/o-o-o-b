<?php
namespace App\Models;
<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
=======
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
>>>>>>> 40d71934e8efdd692ca4a39832f230f02c0c32be
{
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['user_name', 'email', 'mobile', 'password'];

    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps = false;
}

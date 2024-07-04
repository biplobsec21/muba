<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
class UserModel extends Model
{
    
    //
    protected $table="users";
    protected $fillable=['name','username','email','password','password2','user_type','status','created_at',
						'updated_at'];
}

<?php

namespace App\Models\Admin\settings;

use Illuminate\Database\Eloquent\Model;
class UserTypeModel extends Model
{
    
    //
    protected $table="user_type";
    protected $fillable=['name','status','created_by','created_at','updated_at'];
}

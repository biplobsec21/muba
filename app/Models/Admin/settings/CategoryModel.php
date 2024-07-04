<?php

namespace App\Models\Admin\settings;

use Illuminate\Database\Eloquent\Model;
class CategoryModel extends Model
{
    
    //
    protected $table="tbl_category";
    protected $fillable=['name','status','icon','created_at','updated_at'];
}

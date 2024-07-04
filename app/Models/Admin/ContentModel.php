<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
class ContentModel extends Model
{
    
    //
    protected $table="tbl_content";
    protected $fillable=['is_new','jpg_name','png_name','cat_id','created_at','updated_at'];
    public function get_category(){
        return $this->belongsTo(
                'App\Models\Admin\settings\CategoryModel','cat_id');
    }
}

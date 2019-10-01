<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'sub_categories';
    protected $dates = ['deleted_at'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function sub_sub_category()
    {
    	return $this->hasMany(SubSubCategory::class);
    }

}

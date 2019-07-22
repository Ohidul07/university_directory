<?php

namespace App\Models\bsmrau;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'subcategories';
    protected $dates = ['deleted_at'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function subsubcategory()
    {
    	return $this->hasMany(SubSubCategory::class);
    }

}

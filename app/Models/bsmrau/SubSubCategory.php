<?php

namespace App\Models\bsmrau;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'subsubcategories';
    protected $dates = ['deleted_at'];

    public function subcategory()
    {
    	return $this->belongsTo(SubCategory::class);
    }
}

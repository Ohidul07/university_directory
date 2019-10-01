<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sub_Sub_Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'sub_sub_categories';
    protected $dates = ['deleted_at'];

    public function sub_category()
    {
    	return $this->belongsTo(SubCategory::class);
    }
}

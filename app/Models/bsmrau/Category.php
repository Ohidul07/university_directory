<?php

namespace App\Models\bsmrau;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'categories';
    protected $dates = ['deleted_at'];
}

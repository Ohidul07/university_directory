<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    protected $table = 'categories';
    protected $dates = ['deleted_at'];
}

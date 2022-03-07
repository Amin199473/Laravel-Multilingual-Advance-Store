<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_persian',
        'subcategory_slug_en',
        'subcategory_slug_persian',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    public function subsubcategories()
    {
        return $this->hasMany(SubSubCategory::class, 'subcategory_id');
    }
}

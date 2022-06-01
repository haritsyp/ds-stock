<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_has_categories', 'product_id', 'category_id');
    }

}

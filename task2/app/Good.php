<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['id', 'sku', 'name', 'brand', 'categories', 'images', 'link'];

    protected $casts = [
        'categories' => 'array',
        'images' => 'array'
    ];

    public static function addOrUpdate($sku, $name, $brand, $categories, $images, $link) {
        $good = self::firstOrNew(['sku' => $sku]);

        $good->name = $name;
        $good->brand = $brand;
        $good->categories = $categories;
        $good->images = $images;
        $good->link = $link;
        $good->save();

        return $good;
    }
}

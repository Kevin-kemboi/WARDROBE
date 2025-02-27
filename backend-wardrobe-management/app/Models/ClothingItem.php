<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothingItem extends Model
{
    use HasFactory;

    // Specify fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'category',
        'color',
        'size',
        'brand',
        'image_url',
    ];

    // If your table name is different, specify it
    // protected $table = 'your_table_name'; 

    // If your table does NOT have timestamps, disable them
    public $timestamps = false;
}

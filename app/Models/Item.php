<?php

namespace App\Models;

class Item extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'name', 
        'description',
        'is_enabled',
    ];
}

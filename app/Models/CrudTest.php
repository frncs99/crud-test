<?php

namespace App\Models;

class CrudTest extends BaseModel
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

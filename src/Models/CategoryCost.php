<?php

namespace Caju\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCost extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];
}

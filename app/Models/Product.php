<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    public function department(): belongsTo
    {
        return $this->belongsTo(Department::class);
    }


    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

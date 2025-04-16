<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    /**
     * Defines a relationship where this category belongs to a parent category.
     *
     * This method establishes a "belongs to" relationship with the Category model,
     * linking the current category to its parent category using the 'parent_id' foreign key.
     *
     * 
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

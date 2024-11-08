<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilterGroup extends Model
{
    use HasFactory;

    public function options(): HasMany
    {
        return $this->hasMany(FilterOptions::class);
    }
}

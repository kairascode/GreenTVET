<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeSpecies extends Model
{
    protected $fillable = ['name', 'climatic_conditions'];

    public function allocations()
    {
        return $this->hasMany(TreeAllocation::class);
    }

    public function plantings()
    {
        return $this->hasMany(TreePlanting::class);
    }
}

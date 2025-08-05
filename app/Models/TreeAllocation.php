<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeAllocation extends Model
{
     protected $fillable = ['institution_id', 'tree_species_id', 'quantity_allocated', 'allocation_date'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function treeSpecies()
    {
        return $this->belongsTo(TreeSpecies::class);
    }
}

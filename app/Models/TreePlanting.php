<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\TreePlanted;
use App\Events\GrowthStageUpdated;

class TreePlanting extends Model
{
     protected $fillable = ['institution_id', 'tree_species_id', 'quantity_planted', 'planting_date', 'growth_stage', 'pictorial_evidence'];

    protected $dispatchesEvents = [
        'created' => TreePlanted::class,
        'updated' => GrowthStageUpdated::class,
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function treeSpecies()
    {
        return $this->belongsTo(TreeSpecies::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}

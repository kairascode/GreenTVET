<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ChallengeReported;

class Challenge extends Model
{
     protected $fillable = ['institution_id', 'tree_planting_id', 'description', 'reported_date'];

    protected $dispatchesEvents = [
        'created' => ChallengeReported::class,
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function treePlanting()
    {
        return $this->belongsTo(TreePlanting::class);
    }
}

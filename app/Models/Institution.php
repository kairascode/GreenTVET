<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['name', 'location', 'contact_email'];

    public function allocations()
    {
        return $this->hasMany(TreeAllocation::class);
    }

    public function plantings()
    {
        return $this->hasMany(TreePlanting::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}

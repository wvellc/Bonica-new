<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ourTeam extends Model
{
    use HasFactory,Sluggable;

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function scopeActive($query)
    {
        return $query->where('our_teams.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('our_teams.status', 0);
    }

}

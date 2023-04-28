<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guard = [];

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
}

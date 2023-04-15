<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $guard = [];

    public function provider()
    {
        return $this->belongsTo(Facility::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}

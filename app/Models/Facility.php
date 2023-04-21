<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function save(array $options = [])
    {
        $this->generateSlug();
        parent::save($options);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    use HasFactory;

    protected $guard = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
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

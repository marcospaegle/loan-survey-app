<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['name', 'description'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['body'];

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}

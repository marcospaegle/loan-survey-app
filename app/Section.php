<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'description', 'required'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }
}

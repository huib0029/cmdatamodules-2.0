<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'competenties', 'projectgrootte', 'leverancier'
    ];

}

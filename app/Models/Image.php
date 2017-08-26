<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use Uuid32ModelTrait, SoftDeletes, SearchableTrait;

    protected $table = 'image';

    protected $searchable = [
        'columns' => [
            'image.name' => 10,
        ]
    ];
}

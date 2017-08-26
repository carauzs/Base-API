<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use Notifiable, Uuid32ModelTrait, SearchableTrait;

    protected $table = 'user';

    protected $searchable = [
        'columns' => [
            'user.name' => 10,
        ]
    ];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'user_id', 'id');
    }
}

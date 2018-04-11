<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'surname', 'email',
        'phone', 'birth'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
}

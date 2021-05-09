<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use  HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password','c_password',
    ];


}

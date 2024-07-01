<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BookManager extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 'name', 'bookAdminID', 'password',
    ];

    protected $hidden = [
        'id', 'password', 'remember_token',
    ];
}

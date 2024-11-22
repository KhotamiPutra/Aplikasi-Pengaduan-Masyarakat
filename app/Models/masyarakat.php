<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class masyarakat extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'masyarakat';

    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp'
    ];
    protected $primaryKey = 'nik';

    protected $hidden = [
        'password',
    ];

}

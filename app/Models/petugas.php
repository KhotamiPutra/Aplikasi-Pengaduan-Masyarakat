<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class petugas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'petugas';
    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp',
        'level'
    ];
    protected $primaryKey = 'id_petugas';

    protected $hidden = [
        'password',
    ];
public function putra_tanggapan(){
    return $this->hasMany(tanggapan::class, 'id_petugas', 'id_petugas');
}
}

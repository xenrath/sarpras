<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'telp',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function isDev()
    {
        if ($this->role == 'dev') {
            return true;
        } else {
            return false;
        }
    }

    public function isSarpras()
    {
        if ($this->role == 'sarpras') {
            return true;
        } else {
            return false;
        }
    }
    
    public function isBauk()
    {
        if ($this->role == 'bauk') {
            return true;
        } else {
            return false;
        }
    }
    
    public function isSarana()
    {
        if ($this->role == 'sarana') {
            return true;
        } else {
            return false;
        }
    }
    
    public function isPrasarana()
    {
        if ($this->role == 'prasarana') {
            return true;
        } else {
            return false;
        }
    }
}

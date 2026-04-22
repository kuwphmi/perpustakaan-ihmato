<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table yang dipakai (Supabase)
     */
    protected $table = 'users';

    /**
     * Field yang boleh diisi (WAJIB SESUAI DATABASE)
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * Field yang disembunyikan saat JSON response
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast tipe data otomatis
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
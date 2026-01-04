<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable; // Додаємо HasApiTokens сюди

    /**
     * Поля, які можна масово заповнювати.
     * Міняємо 'email' на 'login' згідно з базою.
     */
    protected $fillable = [
        'login',
        'password',
    ];

    /**
     * Приховані поля.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Налаштування типів даних.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
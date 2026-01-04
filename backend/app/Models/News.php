<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * Поля, які можна масово заповнювати.
     */
    protected $fillable = [
        'title', 
        'short_text', 
        'full_text', 
        'category', 
        'image'
    ];

    /**
     * Автоматичне перетворення дати (опціонально для зручності JS)
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];
}
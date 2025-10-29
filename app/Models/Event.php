<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
        'image'
    ];

    // Relasi ke tabel tickets (1 event punya banyak tiket)
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }
}

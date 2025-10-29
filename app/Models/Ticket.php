<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = ['event_id', 'type', 'price', 'stock'];

    // Relasi ke tabel events (tiket milik 1 event)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

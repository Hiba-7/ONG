<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
    protected $fillable = ['numero', 'date_delivrance', 'date_expiration', 'lieu_delivrance', 'scan', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
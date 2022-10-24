<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteCarte extends Model
{
    use HasFactory;
    protected $fillable = ['numero_inscription', 'lieu', 'numero_bureau', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
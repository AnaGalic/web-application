<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function users ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function apartments ()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id'); // Stani kljuc u tablici messages
    }


    public function replies () 
    {
        return $this->hasMany(Reply::class, 'message_id'); // strani kljuc u tablici replies
    }
}

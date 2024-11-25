<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAgent extends Model
{
    protected $fillable = ['artist_id', 'name', 'email', 'phone'];
    
}

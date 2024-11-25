<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistDownload extends Model
{
    protected $fillable = ['artist_id', 'name', 'file'];
}

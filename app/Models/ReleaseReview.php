<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'release_id',
        'name',
        'description',
    ];
}

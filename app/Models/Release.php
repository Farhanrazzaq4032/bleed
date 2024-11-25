<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Release extends Model
{
    protected $fillable = [
        'artist_id',
        'image',
        'name',
        'release_date',
    ];

    public static function boot(){
        parent::boot();

        static::saving(function($model){
            if($model->isDirty('name') || !$model->exists){
                $model->slug = Str::slug($model->name);

                // Check if the slug already exists and append a number if necessary
                $original_slug = $model->slug;
                $count = 2;
                while (static::whereSlug($model->slug)->where('id', '!=', $model->id)->exists()) {
                    $model->slug = $original_slug . '-' . $count++;
                }
            }
        });
   
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function reviews()
    {
        return $this->hasMany(ReleaseReview::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}

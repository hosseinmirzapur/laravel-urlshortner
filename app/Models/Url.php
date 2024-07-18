<?php

namespace App\Models;

use App\Classes\Shortner;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getShortUrlAttribute($short_url)
    {
        return Shortner::builder($short_url);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getListing()
    {
        if ($this->listing_type === 'job') {
            return Job::find($this->listing_id);
        }
        return Internship::find($this->listing_id);
    }
}

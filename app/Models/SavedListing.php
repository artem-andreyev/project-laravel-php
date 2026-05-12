<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedListing extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getListing()
    {
        return $this->listing_type === 'job'
            ? Job::find($this->listing_id)
            : Internship::find($this->listing_id);
    }
}

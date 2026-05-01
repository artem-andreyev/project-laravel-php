<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSkillsArrayAttribute(): array
    {
        return $this->skills
            ? array_map('trim', explode(',', $this->skills))
            : [];
    }
}

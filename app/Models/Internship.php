<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Internship extends Model
{
    use HasFactory;

    protected $table = 'internships';

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}

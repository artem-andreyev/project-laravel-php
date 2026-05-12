<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isJobSeeker(): bool
    {
        return $this->role === 'job_seeker';
    }

    public function canPostListings(): bool
    {
        return in_array($this->role, ['employer', 'admin']);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savedListings()
    {
        return $this->hasMany(SavedListing::class);
    }

    public function hasSaved(string $type, int $id): bool
    {
        return $this->savedListings()
            ->where('listing_type', $type)
            ->where('listing_id', $id)
            ->exists();
    }
}

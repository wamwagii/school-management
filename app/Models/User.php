<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // Add this line

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use CrudTrait, HasFactory, Notifiable, TwoFactorAuthenticatable; // Updated this line

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added for user roles
        'phone', // Added
        'address', // Added
        'profile_image', // Added
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // ===== NEW RELATIONSHIPS FOR SCHOOL MANAGEMENT =====
    
    /**
     * Check if user is a student
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Check if user is a guardian
     */
    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }

    /**
     * Check if user is a teacher
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    /**
     * Get the user's role for display
     */
    public function getRoleDisplayAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'teacher' => 'Teacher',
            'guardian' => 'Guardian',
            'student' => 'Student',
            default => 'User'
        };
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
};
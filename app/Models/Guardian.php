<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Guardian extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = ['user_id', 'occupation', 'employer', 'is_primary'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_student')
                    ->withPivot('relationship')
                    ->withTimestamps();
    }

    // Helper method to get students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->user->name;
    }
};
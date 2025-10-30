<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Student extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = [
        'user_id', 'grade_id', 'admission_number', 'date_of_birth',
        'gender', 'religion', 'nationality', 'has_medical_conditions', 'medical_notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'has_medical_conditions' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student')
                    ->withPivot('relationship')
                    ->withTimestamps();
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->user->name;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Grade extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = ['name', 'description', 'level', 'order'];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class);
    }

    // Helper method to get students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }
};

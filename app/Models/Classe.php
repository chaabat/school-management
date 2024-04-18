<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function subjectToClass()
    {
        return $this->hasMany(SubjetToClass::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function teacherToClasse()
    {
        return $this->hasMany(TeacherToClasse::class);
    }

    public function timetable()
    {
        return $this->hasMany(TimeTable::class);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
}

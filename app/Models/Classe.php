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

    public function subjectToClass(){
        return $this->hasMany(SubjetToClass::class);
    }
    public function user(){
        return $this->hasMany(User::class);
    }
}

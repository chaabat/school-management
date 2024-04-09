<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class SubjetToClass extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $guarded = [];
    
    protected $dates = ['deleted_at']; 

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}

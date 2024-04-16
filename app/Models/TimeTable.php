<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TimeTable extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = [];

    // protected $dates = ['deleted_at'];

    public function cla()
    {
        return $this->belongsTo(Classe::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


}

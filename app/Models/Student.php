<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    //
    use SoftDeletes;

    protected $guarded = ['id'];

    public function major(){
        return $this->belongsTo(Major::class);
    }

    public function student_classes(){
        return $this->hasMany(StudentClass::class);
    }

    public function fee(){
        return $this->hasMany(StudentFee::class);
    }
}

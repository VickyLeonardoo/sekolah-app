<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function major(){
        return $this->belongsTo(Major::class);
    }

    public function student_class(){
        return $this->hasMany(StudentClass::class);
    }

}

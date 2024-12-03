<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    //

    protected $guarded = ['id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }
}

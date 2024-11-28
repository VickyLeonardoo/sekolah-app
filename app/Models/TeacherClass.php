<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    //

    protected $tables = ['teacher_classes'];
    protected $guarded = ['id'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function schoolClass(){
        return $this->belongsTo(SchoolClass::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }
}

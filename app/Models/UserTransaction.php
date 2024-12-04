<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    //

    protected $guarded = ['id'];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
    
    public function student_fee(){
        return $this->belongsTo(StudentFee::class);
    }
}

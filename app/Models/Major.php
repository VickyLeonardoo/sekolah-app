<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    public function class(){
        return $this->hasMany(SchoolClass::class);
    }

}

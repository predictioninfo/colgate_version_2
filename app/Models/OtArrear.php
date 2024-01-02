<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtArrear extends Model
{
    use HasFactory;

    public function userOtArrear(){
        return $this->belongsTo(User::class,'ot_arrear_emp_id');
    }
}

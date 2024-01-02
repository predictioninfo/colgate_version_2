<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDeduction extends Model
{
    use HasFactory;

    public function userOtherDeduction(){
        return $this->belongsTo(User::class,'other_deduction_emp_id');
    }
}
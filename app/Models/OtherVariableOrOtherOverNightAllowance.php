<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherVariableOrOtherOverNightAllowance extends Model
{
    use HasFactory;

    public function userOtVariables(){
        return $this->belongsTo(User::class,'other_variable_or_other_over_night_allowance_emp_id');
    }
}
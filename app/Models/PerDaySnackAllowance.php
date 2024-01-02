<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerDaySnackAllowance extends Model
{
    use HasFactory;

    public function userSnackAllowance(){
        return $this->belongsTo(User::class,'per_day_snack_allowance_emp_id');
    }
}
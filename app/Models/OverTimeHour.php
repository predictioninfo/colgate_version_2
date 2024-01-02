<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTimeHour extends Model
{
    use HasFactory;

    public function userOtHour(){
        return $this->belongsTo(User::class,'over_time_hour_emp_id');
    }
}
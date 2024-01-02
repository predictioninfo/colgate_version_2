<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;

    public function userIncentive(){
        return $this->belongsTo(User::class,'incentive_emp_id');
    }
}
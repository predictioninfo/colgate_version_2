<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prorata extends Model
{
    use HasFactory;

    public function userProrata(){
        return $this->belongsTo(User::class,'prorata_emp_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateSetting extends Model
{
    use HasFactory;
    public function CompanyName(){
    return $this->belongsTo(Company::class,'date_settings_com_id');
    }
}
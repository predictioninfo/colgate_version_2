<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function arearegion(){
        return $this->belongsTo(Region::class,'area_region_id');
    }
}

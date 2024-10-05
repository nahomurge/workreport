<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkRecord extends Model
{
    public function Place(){
        return $this->belongsTo(Place::class, 'placeid', 'id');
    }
}

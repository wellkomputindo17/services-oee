<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleMesin extends Model
{
    use HasFactory;

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }
}

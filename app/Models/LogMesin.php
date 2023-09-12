<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMesin extends Model
{
    use HasFactory;

    public function realtime_mesin()
    {
        return $this->belongsTo(RealTimeMesin::class);
    }

    public function do()
    {
        return $this->belongsTo(DoModel::class, 'no_do', 'no_do');
    }
}

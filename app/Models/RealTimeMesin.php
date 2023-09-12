<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealTimeMesin extends Model
{
    use HasFactory;

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function do()
    {
        return $this->belongsTo(DoModel::class, 'no_do', 'no_do');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationSanction extends Model
{
    public function violationRecords()
    {
        return $this->hasMany(ViolationRecord::class, 'vio_sanct_id');
    }

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }

    public function sanction()
    {
        return $this->belongsTo(Sanction::class);
    }
}

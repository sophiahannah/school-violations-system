<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function violationRecords()
    {
        return $this->hasMany(ViolationRecord::class,  'status_id');
    }
}

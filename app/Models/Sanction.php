<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    public function violationSanctions()
    {
        return $this->hasMany(ViolationSanction::class);
    }
}

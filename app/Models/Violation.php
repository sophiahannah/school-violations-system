<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    public function violationSanctions()
    {
        return $this->hasMany(ViolationSanction::class);
    }
}

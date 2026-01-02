<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationRecord extends Model
{
    use HasFactory; 

    protected $table = 'violation_records'; 

    protected $fillable = [
        'user_id',
        'vio_sanct_id',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    
}

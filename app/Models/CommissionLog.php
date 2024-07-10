<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    use HasFactory;
    function toUser(){
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
    function fromUser(){
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
}

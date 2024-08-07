<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'collect_id',
        'type',
        'description',
    ];
}

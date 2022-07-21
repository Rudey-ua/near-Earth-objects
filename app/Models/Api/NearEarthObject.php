<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearEarthObject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'referenced', 'speed', 'is_hazardous', 'Date'];
}

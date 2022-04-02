<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class awards extends Model
{
    use HasFactory;

    protected $fillable = [
        'award'
    ];

    public function winner()
    {
        return $this->hasOne(winners::class, 'awards_id');
    }
}

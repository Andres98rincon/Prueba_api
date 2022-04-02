<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class winners extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','lastname','phone','address','email','awards_id'
    ];
}

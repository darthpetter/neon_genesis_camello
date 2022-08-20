<?php

namespace App\Models\Nucleo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $fillable=['name'];

    protected $attributes = [
        'status' => 'A',
    ];
}

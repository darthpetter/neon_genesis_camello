<?php

namespace App\Models\Nucleo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;
    protected $table='tbr_sexos';

    protected $fillable=['name'];
}

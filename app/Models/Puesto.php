<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table='puesto';

    protected $primaryKey='id';

    protected $fillable = [
        'name',
    ];
}

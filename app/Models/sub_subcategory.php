<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_subcategory extends Model
{
    use HasFactory;
    protected $table='sub_subcategory';
    protected $column='main';
}

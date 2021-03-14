<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $llaveprimaria = 'id';
   public $incrementing = true;
   protected $tipollave = 'string';
   protected $hidden = ['updated_at','created_at'];
}

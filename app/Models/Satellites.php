<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satellites extends Model
{
    use HasFactory;
    //protected $primaryKey = 'idCategoria';
    public bool $timestamps = false;

    public function getMessageAttribute($value)  {
        return unserialize($value);
    }

    public function getPositionAttribute($value)  {
        return unserialize($value);
    }
}

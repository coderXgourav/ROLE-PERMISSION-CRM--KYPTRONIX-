<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservice extends Model
{
    use HasFactory;
    protected $table = "subservices";
    protected $primaryKey = "id";
}

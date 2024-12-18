<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Subservice extends Model
{
    use HasFactory;
    protected $table = "sub_subservice";
    protected $primaryKey = "sub_subservice_id";
}
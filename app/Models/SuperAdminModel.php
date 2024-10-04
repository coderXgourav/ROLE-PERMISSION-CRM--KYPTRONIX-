<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdminModel extends Model
{
    use HasFactory;
    protected $table = "super_admin";
    protected $primaryKey = "id";
}
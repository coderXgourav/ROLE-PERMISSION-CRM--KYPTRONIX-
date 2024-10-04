<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainUserModel extends Model
{
    use HasFactory;
    protected  $table = 'main_user';
    protected $primaryKey = "id";    
}
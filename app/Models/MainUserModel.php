<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainUserModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $table = 'main_user';
    protected $primaryKey = "id";    
}
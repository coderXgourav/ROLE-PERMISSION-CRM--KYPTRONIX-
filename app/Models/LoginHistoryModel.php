<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistoryModel extends Model
{
    use HasFactory;
    protected $table = "login_history";
    protected $primaryKey = "id";


      protected $fillable = [
        'user_id',
        'ip_address',
        'country',
        'city',
        'region',
        'logged_in_at',
        'operation',
    ];
}
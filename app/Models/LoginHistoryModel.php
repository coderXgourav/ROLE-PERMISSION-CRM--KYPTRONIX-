<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistoryModel extends Model
{
    use HasFactory;
    protected $table = "login_history";
    protected $primaryKey = "id";
    //   protected $fillable = [
    //     'user_id',
    //     'ip_address',
    //     'country',
    //     'city',
    //     'region',
    //     'browser',
    //     'browser_version',
    //     'device_type',
    //     'device_name',
    //     'platform',
    //     'os',
    //     'os_version',
    //     'is_mobile',
    //     'is_tablet',
    //     'is_desktop',
    //     'user_agent'
    // ];
}
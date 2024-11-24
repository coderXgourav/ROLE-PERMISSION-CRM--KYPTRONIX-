<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleService extends Model
{
    use HasFactory;
    protected $table='role_services';
    protected $primaryKey="role_services_id";
}

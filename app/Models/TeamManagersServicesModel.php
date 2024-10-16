<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamManagersServicesModel extends Model
{
    use HasFactory;
    protected $table = "team_manager_services";
    protected $primaryKey = "id";
}
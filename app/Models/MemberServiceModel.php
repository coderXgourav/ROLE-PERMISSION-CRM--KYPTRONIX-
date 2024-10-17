<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberServiceModel extends Model
{
    use HasFactory;
    protected $table = "member_service";
    protected $primaryKey = "id";

}
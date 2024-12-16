<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSubServiceModel extends Model
{
    use HasFactory;
    protected $table = "customer_subservice";
    protected $primaryKey = "customer_subservice_tem_id";
}
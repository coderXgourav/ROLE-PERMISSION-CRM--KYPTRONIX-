<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPackageModel extends Model
{
    use HasFactory;
    protected $table = "customer_package";
    protected $primaryKey = "customer_package_tem_id";
}
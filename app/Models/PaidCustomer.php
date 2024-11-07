<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidCustomer extends Model
{
    use HasFactory;
    protected $table ="paid_customer";
    protected $primaryKey = "paid_customer_id";

}
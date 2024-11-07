<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = "customer";
    protected $primaryKey = "customer_id";

    protected $fillable = [
        'customer_id',
        'customer_service_id',
        'customer_name',
        'customer_number',
        'customer_email',
        'task',
        'team_member',
        'status',
        'type',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'address',
        'city',
        'state',
        'zip',
        'ssn',
        'business_name',
        'industry',
        'ein',
        'business_title',
        'fax',
        'contact_number',
        'contact_email',
        'point_of_contact',
        'msg',
        'updated_at',
        'created_at'
    ];

}
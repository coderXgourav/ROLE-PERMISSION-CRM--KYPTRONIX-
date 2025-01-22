<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    use HasFactory;
    protected $table = "email_send";
    protected $primaryKey = "email_id";
    protected $fillable = [
        'email_id',
        'recipient',
        'subject',
        'body',
        'sent_at',
        'created_at',
        'updated_at'
    ];
    
}
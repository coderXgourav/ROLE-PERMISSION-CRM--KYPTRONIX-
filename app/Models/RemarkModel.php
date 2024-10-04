<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkModel extends Model
{
    use HasFactory;
    protected $table ="remark";
    protected $primaryKey = "remark_id";

}

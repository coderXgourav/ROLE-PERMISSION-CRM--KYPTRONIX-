<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CustomerModel([
            //  name number email message
             'customer_name' => $row['customer_name'],
             'customer_number' => $row['customer_number'],
            'customer_email' => $row['customer_email'],
            'msg'=>$row['msg'],
        ]);
    }
}
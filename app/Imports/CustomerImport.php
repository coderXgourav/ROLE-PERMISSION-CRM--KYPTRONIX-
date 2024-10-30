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
        
        // echo "<pre>";
        // print_r($row);
        // die;

        return new CustomerModel([
             'customer_name' => $row['leadbusiness_name'],
             'customer_number' => $row['leadbusiness_number'],
            'customer_email' => $row['leadbusiness_email'],
            'dob' => $row['dob'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip_code'],
            'ssn' => $row['ssn'],
            'industry' => $row['industry'],
            'ein' => $row['ein'],
            'business_title' => $row['business_title'],
            'point_of_contact' => $row['point_of_contact'],
            'msg' => $row['description'],
        ]);
    }
}
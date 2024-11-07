<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Service;

class CustomerImport implements ToModel,WithHeadingRow, SkipsEmptyRows, WithValidation
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
        $services = Service::pluck('name','service_id')->toArray();
        $serviceId = array_search(strtolower(trim($row['service_name'])), $services);
        
 
        return new CustomerModel([
             'customer_name' => $row['leadbusiness_name'],
             'customer_number' => $row['leadbusiness_number'],
            'customer_email' => $row['leadbusiness_email'],
            'customer_service_id' => !empty($serviceId) ? $serviceId : null, // If service is found, assign its ID; else null
            'dob' => $row['dob'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip_code'],
            'ssn' => $row['ssn'],
            'industry' => $row['industry'],
            'ein' => $row['ein'],
            'fax' => $row['fax'],
            'contact_number' => $row['contact_number'],
            'contact_email' => $row['contact_email'],
            'business_title' => $row['business_title'],
            'point_of_contact' => $row['point_of_contact'],
            'msg' => $row['description'],
        ]);
    }

      public function rules(): array
    {
        return [
            'customer_number' => 'unique:customer',
            'customer_email' => 'unique:customer', 
            'contact_number' => 'unique:customer', 
            'contact_email' => 'unique:customer', 
        ];
    }
}
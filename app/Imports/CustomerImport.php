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
             'customer_name' => $row['business_name'],
             'customer_number' => $row['business_number'],
            'customer_email' => $row['business_email'],
            'customer_service_id' => !empty($serviceId) ? $serviceId : null, // If service is found, assign its ID; else null
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip_code'],
            'industry' => $row['industry'],
            'fax' => $row['fax'],
            'contact_number' => $row['contact_number'],
            'contact_email' => $row['contact_email'],
            'point_of_contact' => $row['point_of_contact'],
            'business_title' => $row['title'],
            'msg' => $row['description'],
        ]);
    }

      public function rules(): array
    {
        return [
            'customer_number' => 'unique:customer',
            'customer_email' => 'unique:customer', 
        ];
    }
}
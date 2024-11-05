<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Service;

class CustomerImport implements ToModel,WithHeadingRow
{
      
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $services = Service::pluck('name','service_id')->toArray();
        $serviceId = array_search(strtolower(trim($row['service_name'])), $services);
        
        // if (!empty($serviceName)) {
    // if (in_array($serviceName, $services)) {
    // } else {
    // return self::toastr('error','Invalid Service Name','error','Error');    
    // }
    // } else {
    //       return self::toastr('error','Empty Service Name','error','Error');    
    // }

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
            'business_title' => $row['business_title'],
            'point_of_contact' => $row['point_of_contact'],
            'msg' => $row['description'],
        ]);
    }
}
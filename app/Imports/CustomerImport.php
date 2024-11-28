<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Service;
use Illuminate\Validation\Rule;


class CustomerImport implements ToModel,WithHeadingRow, SkipsEmptyRows, WithValidation
{
      
    /**
    * @param array $row  
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existingCustomer = null;
        
        if (!empty($row['business_email'])) {
            $existingCustomer = CustomerModel::where('customer_email', $row['business_email'])->first();
        }
        
        if (!$existingCustomer && !empty($row['business_number'])) {
            $existingCustomer = CustomerModel::where('customer_number', $row['business_number'])->first();
        }
        
        // If duplicate found, return null to skip this row
        if ($existingCustomer) {
            return null;
        }
   
 
        return new CustomerModel([
             'customer_name' => $row['business_name'],
             'customer_number' => $row['business_number'],
            'customer_email' => $row['business_email'],
            // 'customer_service_id' => !empty($serviceId) ? $serviceId : null,
            'customer_service_id' => 14,
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
            'business_email' => [
                'nullable',
                Rule::unique('customer', 'customer_email')
            ],
            'business_number' => [
                'nullable',
                Rule::unique('customer', 'customer_number')
            ]
        ];
    }

    public function customValidationMessages()
    {
        return [
            'business_email.unique' => 'The email address already exists in the system.',
            'business_number.unique' => 'The phone number already exists in the system.'
        ];
    }
}
<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use App\Models\Service;

class IndividualImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check for potential duplicates only if email or phone is not empty
        $existingCustomer = null;
        
        // Check for duplicate email if email is not empty
        if (!empty($row['email_address'])) {
            $existingCustomer = CustomerModel::where('customer_email', $row['email_address'])->first();
        }
        
        // Check for duplicate phone if phone is not empty and no existing customer found
        if (!$existingCustomer && !empty($row['phone_number'])) {
            $existingCustomer = CustomerModel::where('customer_number', $row['phone_number'])->first();
        }
        
        // If duplicate found, return null to skip this row
        if ($existingCustomer) {
            return null;
        }
        
        return new CustomerModel([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'customer_email' => $row['email_address'] ?? null,
            'customer_number' => $row['phone_number'] ?? null,
            'customer_name' => $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'],
            'customer_service_id' => 14,
            'dob' => $row['date_of_birth'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip_code'],
            'ssn' => $row['ssn'],
            'msg' => $row['description'],
        ]);
    }

    public function rules(): array
    {
        return [
            'email_address' => [
                'nullable',
                Rule::unique('customer', 'customer_email')
            ],
            'phone_number' => [
                'nullable',
                Rule::unique('customer', 'customer_number')
            ]
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email_address.unique' => 'The email address already exists in the system.',
            'phone_number.unique' => 'The phone number already exists in the system.'
        ];
    }
}
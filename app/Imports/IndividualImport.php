<?php

namespace App\Imports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
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
        // Fetch the list of services from the Service model
        $services = Service::pluck('name', 'service_id')->toArray();
        $serviceId = array_search(strtolower(trim($row['service_name'])), $services);

   

        // If no duplicate, create a new customer record
        return new CustomerModel([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'customer_email' => $row['email_address'],
            'customer_number' => $row['phone_number'],
            'customer_name' => $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'],
            'customer_service_id' => !empty($serviceId) ? $serviceId : null, // Assign service ID if found
            'dob' => $row['data_of_birth'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip_code'],
            'ssn' => $row['ssn'],
            'msg' => $row['description'],
        ]);
    }

    /**
     * Validation rules for each row
     */
    public function rules(): array
    {
        return [
            // Optional: You can keep validation, but now we'll handle duplicates before insertion
            'customer_number' => 'unique:customer', // We're manually handling duplicate check
            'customer_email' => 'unique:customer',  // We're manually handling duplicate check
        ];
    }
}
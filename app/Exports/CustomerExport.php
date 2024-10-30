<?php

namespace App\Exports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerModel::select('customer_name','business_name','industry','customer_number','customer_email','dob','address','city','state','zip','ssn','ein','business_title','point_of_contact','msg')->get();
    }
}
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
        return CustomerModel::select('customer_name','customer_number','customer_email')->get();
    }
}
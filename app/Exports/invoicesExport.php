<?php

namespace App\Exports;

use App\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;

class invoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return invoices::all();
        return invoices::select('invoice_number','invoice_Date','Due_date','product','Amount_collection','Amount_Commission','Discount','Value_VAT','Total','Status','note');
    }
}

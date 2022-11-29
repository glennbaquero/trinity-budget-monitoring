<?php

namespace App\Exports\Requests;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PORequestExport implements FromArray, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function array(): array
    {
    	$result = [];

    	foreach ($this->items as $item) {
    		$result[] = [
                '#' => $item['id'],
	            'PO Number' => $item['po_number'],
	            'PO Name' => $item['name'],
	            'PPP Request' => $item['ppp_request'],
	            'Date' => $item['date'],
	            'Requested Amount' => $item['request_amount'],
	            'Transaction Currency' => $item['transaction_currency'],
	            'Transaction Group' => $item['transaction_group'],
	            'Supplier' => $item['supplier'],
	            'Country' => $item['country'],
	            'Exchange Rate' => $item['exchange_rate'],
	            'Program Title' => $item['program_title'],
	            'Purpose' => $item['purpose'],
	            'Denied Date' => $item['denied_at'],
	            'Resubmitted Date' => $item['manager_approved_at'],
	            'District Manager Approved Date' => $item['district_manager_approved_at'],
	            'Manager Approved Date' => $item['district_manager_approved_at'],
	            'Management Approved Date' => $item['resubmitted_at'],
            ];
    	}

        return $result;
    }

    public function headings(): array
    {
        return [
            '#',
            'PO Number',
            'PO Name',
            'PPP Request',
            'Date',
            'Requested Amount',
            'Transaction Currency',
            'Transaction Group',
            'Supplier',
            'Country',
            'Exchange Rate',
            'Program Title',
            'Purpose',
            'Denied Date',
            'Resubmitted Date',
            'District Manager Approved Date',
            'Manager Approved Date',
            'Management Approved Date',
        ];
    }
}

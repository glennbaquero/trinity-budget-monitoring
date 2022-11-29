<?php

namespace App\Exports\Requests;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PPPRequestExport implements FromArray, WithStrictNullComparison, WithHeadings, ShouldAutoSize
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
                'PPP Number' => $item['number'],
                'PPP Name' => $item['name'],
                'Main Budget' => $item['budget'],
                'Brand' => $item['product'],
                'Line Business' => $item['line_business'],
                'Date Period' => $item['date_period'],
                'Requested Amount' => $item['request_amount'],
                'Current Balance' => $item['current_balance'],
                'Denied Date' => $item['denied_at'],
                'Resubmitted Date' => $item['resubmitted_at'],
                'Finance Approved Date' => $item['financed_approved_at'],
                'Management Approved Date' => $item['admin_approved_at'],
            ];
    	}

        return $result;
    }

    public function headings(): array
    {
        return [
            '#',
            'PPP Number',
            'PPP Name',
            'Main Budget',
            'Brand',
            'Line Business',
            'Date Period',
            'Requested Amount',
            'Current Balance',
            'Denied Date',
            'Resubmitted Date',
            'Finance Approved Date',
            'Management Approved Date',
        ];
    }
}

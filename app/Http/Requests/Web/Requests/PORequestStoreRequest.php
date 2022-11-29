<?php

namespace App\Http\Requests\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PORequestStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ppp_request_id' => 'required|numeric',
            'country' => 'required',
            'name' => 'required',
            'po_date' => 'required|date',
            'program_title' => 'required',
            'purpose' => 'required',
            'request_amount' => 'required',
            'transaction_currency' => 'required',
            'transaction_group' => 'required',
            'exchange_rate' => 'required',
            'supplier' => 'required',
            'status' => 'required|numeric',
            // 'files.*' => 'mimes:pdf, pdf, docx, docs, xlxs, xls',
        ];
    }

    public function messages()
    {
        return [
            'ppp_request_id.required' => 'Please select PPP name request budget data.',
            'ppp_request_id.numeric' => 'PPP name request budget must be a valid data.',
            'po_date.required' => 'PO date is required.',
            'po_date.date' => 'PO date must be a valid date.',
            'program_title.required' => 'Program title is required.',
            'request_amount.required' => 'Requested amount is required.',
            'request_amount.numeric' => 'Requested amount must be a valid amount.',
            'transaction_currency.required' => 'Transaction currency is required.',
            'transaction_group.required' => 'Transaction group is required.',
            'exchange_rate.required' => 'Exchange rate is required.',
            'status.required' => 'Status is required.',
            'status.numeric' => 'Status must be valid data.',
            // 'files.*.mimes' => 'Only pdf, docx, docs, xlxs, or xls file are allowed'
        ];
    }
}

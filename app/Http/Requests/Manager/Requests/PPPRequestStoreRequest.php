<?php

namespace App\Http\Requests\Manager\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PPPRequestStoreRequest extends FormRequest
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
            'name' => 'required',
            'budget_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'requested_amount' => 'required|numeric',
            'line_business' => 'required',
            'period_start_at' => 'required|date',
            'period_end_at' => 'required|date',
            'files.*' => 'mimes:pdf, pdf, docx, docs, xlxs, xls',
        ];
    }

    public function messages()
    {
        return [
            'budget_id.required' => 'Please choose main budget.',
            'product_id.required' => 'Please choose product.',
            'budget_id.numeric' => 'Main budget must be valid data.',
            'product_id.numeric' => 'Product must be valid data.',
            'requested_amount.required' => 'Requested amount is required.',
            'requested_amount.numeric' => 'Requested amount must be a valid amount.',
            'line_business.required' => 'Line business is required.',
            'period_start_at.required' => 'Date period start is required.',
            'period_end_at.required' => 'Date period end is required.',
            'period_start_at.date' => 'Date period start must be valid date.',
            'period_end_at.date' => 'Date period end must be valid date.',
            'files.*.mimes' => 'Only pdf, docx, docs, xlxs, or xls file are allowed'
        ];
    }
}

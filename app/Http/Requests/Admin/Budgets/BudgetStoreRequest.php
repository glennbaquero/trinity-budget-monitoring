<?php

namespace App\Http\Requests\Admin\Budgets;

use Illuminate\Foundation\Http\FormRequest;

class BudgetStoreRequest extends FormRequest
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
        $id = $this->route('id');
        $isRequired = 'required';
        if($id) {
            $isRequired = null;
        }
        $rules = [
            'name' => ['required'],
            'period_start_at' => ['required'],
            'period_end_at' => ['required'],             
            'budget_amount' => [$isRequired],
        ];

        return $rules;
    }

    public function messages() {
        return [
            'period_start_at.required' => 'Period Validity Start Field is required, please add validity start.',
            'period_end_at.required' => 'Period Validity End Field is required, please add validity end.',
        ];
    }    
}

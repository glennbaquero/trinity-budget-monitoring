<?php

namespace App\Http\Requests\Admin\Specializations;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationStoreRequest extends FormRequest
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
        
        return [
             'name' => 'required',
             'description' => 'required',

        ];
    }
}

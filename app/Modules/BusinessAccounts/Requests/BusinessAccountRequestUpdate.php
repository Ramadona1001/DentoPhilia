<?php

namespace BusinessAccounts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessAccountRequestUpdate extends FormRequest
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
            'password' => 'confirmed',
            'commercial_record' => 'required|max:2048',
            'tax_card' => 'required|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => transWord('Email').' '.transWord('is already exists'),
            'password.confirmed' => transWord('Password does not match'),
            'commercial_record.required' => transWord('Commercial Record').' '.transWord('is required'),
            'tax_card.required' => transWord('Tax Card').' '.transWord('is required'),
            'commercial_record.max' => transWord('Max of commercial recored').' '.transWord('is 2 mg'),
            'tax_card.max' => transWord('Max of tax card').' '.transWord('is 2 mg'),
        ];
    }
}

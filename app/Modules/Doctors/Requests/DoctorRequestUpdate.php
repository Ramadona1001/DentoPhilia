<?php

namespace Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequestUpdate extends FormRequest
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
            'faculty' => 'required',
            'start_date' => 'required',
            'address' => 'required',
            'bio' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => transWord('Email').' '.transWord('is already exists'),
            'password.confirmed' => transWord('Password does not match'),
            'faculty.required' => transWord('Faculty').' '.transWord('is required'),
            'start_date.required' => transWord('Start Study Date').' '.transWord('is required'),
            'address.required' => transWord('Address').' '.transWord('is required'),
            'bio.required' => transWord('BIO').' '.transWord('is required'),
        ];
    }
}

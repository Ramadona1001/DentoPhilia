<?php

namespace Services\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title' => 'required|min:2|max:255',
            'icon' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => transWord('Title').' '.transWord('is required'),
            'icon.required' => transWord('Icon').' '.transWord('is required'),
        ];
    }
}

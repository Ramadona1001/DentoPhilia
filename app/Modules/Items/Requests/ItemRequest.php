<?php

namespace Items\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'price' => 'required|numeric',
            'desc' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => transWord('Name').' '.transWord('is required'),
            'desc.required' => transWord('Description').' '.transWord('is required'),
            'price.required' => transWord('Price').' '.transWord('is required'),
            'price.numeric' => transWord('Price').' '.transWord('should be number'),

            'image.required' => transWord('Image').' '.transWord('is required'),
            'image.max' => transWord('Max of image').' '.transWord('is 2 mg'),
            'image.mimes' => transWord('Image').' '.transWord('is not valid'),
        ];
    }
}

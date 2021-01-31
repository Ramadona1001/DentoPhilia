<?php

namespace Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'slug' => 'required|unique:categories,slug',
            'content' => 'required|min:2',
            'image' => 'mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => transWord('Title').' '.transWord('is required'),
            'title.min' => transWord('Min Characters of Title are 2'),
            'title.max' => transWord('Max Characters of Title are 255'),

            'slug.required' => transWord('Slug').' '.transWord('is required'),
            'slug.unique' => transWord('Slug').' '.transWord('is already exists'),

            'content.required' => transWord('Content').' '.transWord('is required'),
            'content.max' => transWord('Min Characters of Content are 2'),

            'image.mimes' => transWord('Image should be (png | jpg | jpeg)'),
        ];
    }
}

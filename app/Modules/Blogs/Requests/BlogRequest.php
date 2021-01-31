<?php

namespace Blogs\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'tags' => 'required',
            'content' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => transWord('Title').' '.transWord('is required'),
            'title.min' => transWord('Min Characters of Title are 2'),
            'title.max' => transWord('Max Characters of Title are 255'),

            'tags.required' => transWord('Tags').' '.transWord('is required'),

            'content.required' => transWord('Content').' '.transWord('is required'),
            'content.max' => transWord('Min Characters of Content are 2'),
        ];
    }
}

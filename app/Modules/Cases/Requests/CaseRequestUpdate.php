<?php

namespace Cases\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseRequestUpdate extends FormRequest
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
            'preoperative_title' => 'required',
            'preoperative_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'processingoperative_title' => 'required',
            'processingoperative_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'postoperative_title' => 'required',
            'postoperative_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'preoperative_title.required' => transWord('Pre Operative Title').' '.transWord('is required'),
            'processingoperative_title.required' => transWord('Processing Operative Title').' '.transWord('is required'),
            'postoperative_title.required' => transWord('Post Operative Title').' '.transWord('is required'),

            'preoperative_image.image' => transWord('Pre Operative Image').' '.transWord('is not image'),
            'processingoperative_image.image' => transWord('Processing Operative Image').' '.transWord('is not image'),
            'postoperative_image.image' => transWord('Post Operative Image').' '.transWord('is not image'),

            'preoperative_image.mimes' => transWord('Pre Operative Image').' '.transWord('is not image'),
            'processingoperative_image.mimes' => transWord('Processing Operative Image').' '.transWord('is not image'),
            'postoperative_image.mimes' => transWord('Post Operative Image').' '.transWord('is not image'),

            'preoperative_image.max' => transWord('Pre Operative Image').' '.transWord('maximum size is 2 mg'),
            'processingoperative_image.max' => transWord('Processing Operative Image').' '.transWord('maximum size is 2 mg'),
            'postoperative_image.max' => transWord('Post Operative Image').' '.transWord('maximum size is 2 mg'),

        ];
    }
}

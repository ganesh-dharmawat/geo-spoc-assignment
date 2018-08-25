<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateInfo extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:candidate_info',
            'url' => 'required|url',
            'cover_letter' => 'required|max:255',
            'attachment' => 'required|file|max:1024|mimes:doc,docx,pdf',
            'like_working' => 'required',
            'captcha' => 'required|captcha'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'captcha.captcha'=>'Invalid captcha code.'
        ];
    }
}

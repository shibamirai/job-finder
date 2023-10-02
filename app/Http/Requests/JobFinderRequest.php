<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class JobFinderRequest extends FormRequest
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
            'avatar' => 'required',
            // 'name' => ['required', Rule::unique('job_finders')->ignore($this->route()->parameter('job_finder'))],
            'name' => ['required', Rule::unique('job_finders')->ignore($this->job_finder)],
            'gender_id' => 'required',
            'age' => 'required|integer|between:18,65',
            'handicaps' => 'required',
            'has_certificate' => 'required',
            'use_from' => 'required',
            'skills' => 'nullable',
            'occupation' => 'required',
            'description' => 'nullable',
            'hired_at' => 'required',
            'employment_pattern_id' => 'required',
            'is_handicaps_opened' => ['required']
        ];
    }
}

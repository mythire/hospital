<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClinicFormRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'email.email' => 'Enter a valid email',
            'website.url' => 'Enter a valid website',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|string|url|max:255',
            'contact_nos' => 'nullable|string',
            'street_no' => 'nullable|string|max:255',
            'street_line_1' => 'nullable|string|max:255',
            'street_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:255',
            'start_time_1' => 'required',
            'close_time_1' => 'required',
            'start_time_2' => 'required',
            'close_time_2' => 'required',
            'start_time_3' => 'required',
            'close_time_3' => 'required',
            'start_time_4' => 'required',
            'close_time_4' => 'required',
            'start_time_5' => 'required',
            'close_time_5' => 'required',
            'start_time_6' => 'required',
            'close_time_6' => 'required',
            'start_time_7' => 'required',
            'close_time_7' => 'required',
            'active_status' => 'required',
        ];
    }
}

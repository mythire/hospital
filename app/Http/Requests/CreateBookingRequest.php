<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateBookingRequest extends FormRequest
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
        if (auth()->check()) {
            return [
                "title" => 'nullable|string|max:255',
                "first_name" => 'nullable|string|max:255',
                "last_name" => 'nullable|string|max:255',
                "display_name" => 'required|string|max:255',
                "ph_no" => 'nullable|string|phone:LK',
                "email" => 'nullable|string|email',
                "city" => 'required|string',
                "location_string" => 'string',
                "identification" => 'required',
                "identification_number" => [
                    'required_with:identification',
                    function($attribute, $value, $fail) {
                        
                        if ($this->identification == 'nic') {
                            
                            //accepts new and old nic types

                            if (preg_match('/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $value) == false) {
                                
                                $fail('Entered NIC is invalid. Try again!');
                            }
                        }

                    }
                ]
            ];

        }
        return [
            "title" => 'required|string|max:255',
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "display_name" => 'required|string|max:255',
            "ph_no" => 'required|string|phone:LK',
            "email" => 'required|string|email',
            "city" => 'required|string',
            "location_string" => 'string',
            "identification" => 'required',
            "identification_number" => [
                'required_with:identification',
                function($attribute, $value, $fail) {
                    
                    if ($this->identification == 'nic') {
                        
                        //accepts new and old nic types

                        if (preg_match('/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $value) == false) {
                            
                            $fail('Entered NIC is invalid. Try again!');
                        }
                    }

                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Saluation is required',
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'display_name.required' => 'Display name is required',
            'ph_no.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'city.required' => 'City is required',
            'identification.required' => 'Identification is required',
            'identification_number.required_with' => 'An Identification number is required',
        ];
    }


}

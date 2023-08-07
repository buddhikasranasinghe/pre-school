<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreSchoolApplicationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'gender' => 'required',
            'birthday' => 'required|date',
            'birth_weight' => 'required|regex:/^[0-9\.]+$/',
            'current_weight' => 'required|regex:/^[0-9\.]+$/',
            'mother_full_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'farther_full_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'guardiant_full_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'permenent_address' => 'required|regex:/^[-0-9A-Za-z.,\/ ]+$/',
            'home_contact_number' => 'required|regex:/^\+?\d{10,11}$/',
            'personal_contact_number' => 'required|regex:/^\+?\d{10,11}$/',
            'email_address' => 'required|email',
            'emergency_informer_name' => 'required|regex:/^[A-Za-z\s\.]+$/',
            'emergency_informer_contact_number' => 'required|regex:/^\+?\d{10,11}$/'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Student name can\'t be empty',
            'full_name.regex' => 'Invalied charactors in student name',
            'gender.required' => 'Gender can\'t be empty',
            'birthday.required' => 'Birthday can\'t be empty',
            'birthday.date' => 'Birthday should be a date',
            'birth_weight.required' => 'Birth weight can\'t be empty',
            'birth_weight.regex' => 'Birth weight shoud be numeric value',
            'current_weight.required' => 'Current weight can\'t be empty',
            'current_weight.regex' => 'Current weight shoud be numeric value',
            'mother_full_name.required' => 'Mother\'s name can\'t be empty',
            'mother_full_name.regex' => 'Invalied charactors in mother\'s name',
            'farther_full_name.required' => 'Farther\'s name can\'t be empty',
            'farther_full_name.regex' => 'Invalied charactors in farther\'s name',
            'guardiant_full_name.required' => 'Guardiant\'s name can\'t be empty',
            'guardiant_full_name.regex' => 'Invalied charactors in guardiant\'s name',
            'permenent_address.required' => 'Permenent address can\'t be empty',
            'permenent_address.regex' => 'Invalied charactors in permenent address',
            'home_contact_number.required' => 'Home contact number can\'t be empty',
            'home_contact_number.regex' => 'Invalied contact number',
            'personal_contact_number.required' => 'Personal contact number can\'t be empty',
            'personal_contact_number.regex' => 'Invalied contact number',
            'email_address.required' => 'Email can\'t be empty',
            'email_address.email' => 'Invalied email address',
            'emergency_informer_name.required' => 'Emergency informar name can\'t be empty',
            'emergency_informer_name.regex' => 'Invalied emergency informer name',
            'emergency_informer_contact_number.required' => 'Emergency informer contact number can\'t be empty',
            'emergency_informer_contact_number.regex' => 'Invalied contact number'
        ];
    }
}

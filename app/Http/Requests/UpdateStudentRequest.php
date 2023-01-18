<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'same:confirm-password',
            'dob' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'nic' => 'required|regex:/^\d{9}V$/',
            'phno' => 'required|min:10'
        ];
    }
}

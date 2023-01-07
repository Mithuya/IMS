<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
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

                'title' => 'required',
                'subject_id' => 'required',
                'description' => 'required',
                'duration' => 'required',
                'examiner_id' => 'required',
                'invigilator_id' => 'required',
                'date_time' => 'required'


        ];
    }
}

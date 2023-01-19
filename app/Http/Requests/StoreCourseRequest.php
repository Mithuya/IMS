<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'title' => 'required|max:50|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'course_title.required' => 'Title is required!',
            'course_title.max' => 'Title shoud below 50 characters!',
            'course_duration.required' => 'Description is required!',
            'duration.required' => 'Duration is required!',
            'course_start_date.required' => 'Start Date is required!',
            'course_end_date.required' => 'End Date is required!'
        ];
    }
}

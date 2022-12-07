<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'course_title' => 'required|max:50|alpha',
            'course_description' => 'required|string',
            'course_duration' => 'required|string',
            'course_start_date' => 'required|date',
            'course_end_date' => 'required|date'
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
            'course_title.alpha' => 'Title shoud be alpha!',
            'course_duration.required' => 'Description is required!',
            'duration.required' => 'Duration is required!',
            'course_start_date.required' => 'Start Date is required!',
            'course_end_date.required' => 'End Date is required!'
        ];
    }
}

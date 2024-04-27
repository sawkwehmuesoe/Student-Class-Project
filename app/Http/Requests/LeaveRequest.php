<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //if false = 403 THIS ACTION IS UNAUTHORIZED.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            'tag'=>'required',
            'title'=>'required|max:50',
            'content'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:1024'
        ];
    }

    public function attributes()
    {
        return [
            'post_id'=>'class',
            'startdate'=>'start date',
            'enddate'=>'end date',
            'tag'=>'authorize person',
        ];
    }

    public function messages()
    {
        return [
            'post_id.required'=>"class can't be empty",
            'startdate.required'=>"start date can't be empty",
            'enddate.required'=>"end date can't be empty",
            'tag.required'=>"authorize person must be choose",
        ];
    }
}

// edit
// delete
// search
// filter

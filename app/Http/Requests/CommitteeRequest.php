<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeRequest extends FormRequest
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
            'name' => 'required',
            'total_members' => 'required',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is missing!',
            'total_members.required' => 'Total members is required!',
            'start_date.before' => 'Start date required and  must be less then end date!',
            'end_date.after' => 'End date required and  must be greater then start date!',
            'amount.required' => 'Amount is required!'
        ];
    }
}

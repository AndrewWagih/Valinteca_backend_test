<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /* 
        notes :-
        you will found postman collection with questions key to test code in https://github.com/AndrewWagih/Valinteca_backend_test/blob/main/task%20backend.postman_collection.json
    
    */
    public function prepareForValidation()
    {
        $this->merge([
            'started_at' => $this->input('start_date') . ' ' . $this->input('start_time'),
            'ended_at' => $this->input('end_date') . ' ' . $this->input('end_time'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'started_at' => ['required', 'date_format:Y-m-d H:i:s', 'after:now'],
            'ended_at' => ['required', 'date_format:Y-m-d H:i:s', 'after:started_at'],
        ];
    }
}

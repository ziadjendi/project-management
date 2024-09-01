<?php

namespace App\Http\Requests;


class UpdateUserRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'gender' => 'sometimes|required|in:male,female',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => 'sometimes|required|string|min:8',
        ];
    }
}

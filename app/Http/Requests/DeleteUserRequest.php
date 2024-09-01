<?php

namespace App\Http\Requests;


class DeleteUserRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
        ];
    }
}

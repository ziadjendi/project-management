<?php

namespace App\Http\Requests;

class DeleteProjectRequest extends BaseFormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:projects,id',
        ];
    }
}

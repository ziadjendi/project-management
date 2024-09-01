<?php

namespace App\Http\Requests;

class UpdateProjectRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:projects,id',
            'name' => 'sometimes|required|string|max:255',
            'department' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'sometimes|required|in:planned,ongoing,completed',
        ];
    }
}

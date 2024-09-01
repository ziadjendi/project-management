<?php
namespace App\Http\Requests;

class UpdateTimesheetRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:timesheets,id',
            'task_name' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'hours' => 'sometimes|required|integer|min:1',
            'user_id' => 'sometimes|required|exists:users,id',
            'project_id' => 'sometimes|required|exists:projects,id',
        ];
    }
}

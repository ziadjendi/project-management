<?php
namespace App\Http\Requests;

class StoreTimesheetRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}

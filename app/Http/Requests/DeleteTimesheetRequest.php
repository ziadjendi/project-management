<?php
namespace App\Http\Requests;

class DeleteTimesheetRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:timesheets,id',
        ];
    }
}

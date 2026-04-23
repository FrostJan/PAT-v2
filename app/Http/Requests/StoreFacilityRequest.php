<?php

namespace App\Http\Requests;

use App\Enums\Department;
use App\Models\FacilityRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreFacilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', FacilityRequest::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'activity_purpose_id' => ['required', 'integer', 'exists:activity_purposes,id'],
            'department' => ['required', 'string', 'in:'.implode(',', Department::values())],
            'division' => ['required', 'string', 'max:255'],
            'attendees' => ['required', 'integer', 'min:1', 'max:100000'],
            'date_filed' => ['required', 'date'],
            'date_needed' => ['required', 'date', 'after_or_equal:date_filed'],
            'time_needed_start' => ['required', 'date_format:H:i'],
            'time_needed_end' => ['required', 'date_format:H:i', 'after:time_needed_start'],
            'person_in_charge' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:50'],
            'services' => ['required', 'array'],
            'services.pat' => ['required', 'boolean'],
            'services.emc_room' => ['required', 'boolean'],
            'services.tv_room' => ['required', 'boolean'],
            'classification' => ['required', 'array'],
            'classification.institutional' => ['required', 'boolean'],
            'classification.curricular' => ['required', 'boolean'],
            'classification.co_curricular' => ['required', 'boolean'],
            'classification.extra_curricular' => ['required', 'boolean'],
            'classification.outside_group' => ['required', 'boolean'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:10240'],
        ];
    }
}

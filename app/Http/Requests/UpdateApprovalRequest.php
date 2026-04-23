<?php

namespace App\Http\Requests;

use App\Enums\RequestStatus;
use App\Models\FacilityRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApprovalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('approve', FacilityRequest::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([RequestStatus::Approved->value, RequestStatus::Declined->value])],
        ];
    }
}

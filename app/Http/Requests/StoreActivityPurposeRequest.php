<?php

namespace App\Http\Requests;

use App\Models\ActivityPurpose;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityPurposeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage', ActivityPurpose::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:activity_purposes,name,'.$this->route('activity_purpose')?->id],
        ];
    }
}

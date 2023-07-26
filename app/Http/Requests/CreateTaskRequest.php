<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'type' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'creator_id' => ['required', 'integer'],
            'assignee_id' => ['nullable', 'integer'],
            'tester_id' => ['nullable', 'integer'],
            'status_id' => ['required', 'integer'],
        ];
    }
}

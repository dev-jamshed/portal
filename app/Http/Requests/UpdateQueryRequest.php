<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            // 'category' => 'required|string|max:255',
            'status' => 'required|in:Active,Pending,Process,Avoid,Cancel',
            'assigned_to' => 'nullable|exists:users,id',
            'comments' => 'array',
            'comments.*.comment' => 'required_with:comments|string',
        ];
    }
}

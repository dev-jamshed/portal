<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        // return [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'phone' => 'nullable|string|max:15', // Adjust validation rules as needed
        //     'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional, adjust as needed
        //     'roles' => 'array',
        //     'roles.*' => 'string|exists:roles,name',
        // ];


        return [
            'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric',
        'password' => 'required',
        'roles' => 'required'
        ];


      



    }
    
}
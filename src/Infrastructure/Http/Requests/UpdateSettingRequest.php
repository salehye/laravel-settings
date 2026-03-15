<?php

namespace Salehye\LaravelSettings\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Middleware handles authorization
    }

    public function rules(): array
    {
        return [
            'value' => 'required',
            'type' => 'nullable|string|in:string,integer,boolean,array,json,float',
            'group' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}

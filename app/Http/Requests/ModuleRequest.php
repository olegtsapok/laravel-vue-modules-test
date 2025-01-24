<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class for configuration model validation rules
 */
class ModuleRequest extends BaseRequest
{
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'color.regex' => 'The color field format is invalid. Use #RRGGBB',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($modelId = null): array
    {
        $isNew = $this->isNew($modelId);

        return [
            'url' => [
                Rule::requiredIf($isNew),
                'url',
            ],
            'height' => [
                Rule::requiredIf($isNew),
                'integer',
                'between:1,100',
            ],
            'width' => [
                Rule::requiredIf($isNew),
                'integer',
                'between:1,100',
            ],
            'color' => [
                Rule::requiredIf($isNew),
                'regex:/^#[0-9,a-f,A-F]{6}$/',
            ]
        ];
    }
}

<?php

namespace App\Http\Requests\Demo;

use Illuminate\Foundation\Http\FormRequest;

class DemoModeRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'mode' => ['sometimes', 'string', 'in:before,after,gotcha'],
        ];
    }

    public function mode(): string
    {
        return $this->validated('mode', 'before');
    }
}

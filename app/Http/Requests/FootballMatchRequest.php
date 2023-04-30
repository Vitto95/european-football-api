<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FootballMatchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'homeTeamName' => 'required|string|min:3',
            'awayTeamName' => 'required|string|min:3',
            'startsDate' => 'required|date',
            'startsTime' => 'required|date_format:H:i'
        ];
    }
}

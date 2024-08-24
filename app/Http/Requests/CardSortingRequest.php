<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardSortingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cards' => ['required', 'array'],
            'cards.*.id' => ['required', 'integer', 'exists:App\Models\Card,id'],
            'cards.*.column_id' => ['required', 'integer', 'exists:App\Models\BoardColumn,id'],
            'cards.*.position' => ['required', 'integer'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\QuestCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreQuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty_level' => 'required|integer|between:1,5',
            // DIT IS DE FIX: Controleer of de categorie in de Enum zit
            'category' => ['required', new Enum(QuestCategory::class)],
            'is_active' => 'nullable',
            'parts' => 'required|array|min:1',
            'parts.*.name' => 'required|string|max:255',
            'parts.*.description' => 'required|string',
            'parts.*.success_condition' => 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Quest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::authorize('create', Quest::class)->allowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:300',
            'difficulty_level' => 'required|in:1,2,3',
            'category' => 'required'
        ];
    }
}

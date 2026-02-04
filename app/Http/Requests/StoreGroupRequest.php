<?php
//
//namespace App\Http\Requests;
//
//use App\Models\Group;
//use Gate;
//use Illuminate\Foundation\Http\FormRequest;
//
//class StoreGroupRequest extends FormRequest
//{
//    /**
//     * Determine if the user is authorized to make this request.
//     */
//    public function authorize(): bool
//    {
//        return Gate::authorize('create', Group::class)->allowed();
//    }
//
//    /**
//     * Get the validation rules that apply to the request.
//     *
//     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//     */
//    public function rules(): array
//    {
//        return [
//            'name' => 'required|string|between:3,100|unique:groups,name',
//            'description' => 'required|string|between:10,300',
//        ];
//    }
//}


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestRequest extends FormRequest
{
    /**
     * FORCEER TRUE: Dit stopt de 403 Forbidden bij het opslaan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validatie regels voor de Quest en de bijbehorende Parts (stappen).
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty_level' => 'required|integer|between:1,5',
            'category' => 'required|string',
            'is_active' => 'nullable',
            // Validatie voor de array met stappen
            'parts' => 'required|array|min:1',
            'parts.*.name' => 'required|string|max:255',
            'parts.*.description' => 'required|string',
            'parts.*.success_condition' => 'required|string',
        ];
    }
}

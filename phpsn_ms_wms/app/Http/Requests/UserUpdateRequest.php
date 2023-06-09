<?php

namespace App\Http\Requests;

use App\Domain\Models\user;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'role_id' => 'required|numeric|min:1|max:2|',
            'name' => 'required|string|max:20',
            'email' => ['email', 'max:255', Rule::unique(user::class)->ignore($this->user->id)],
            'password' => 'nullable|min:5',
        ];
    }
}

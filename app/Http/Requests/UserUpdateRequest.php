<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route("evaluateur");
        return [
            'name' => ['required','string','min:2'],
            'email' => ['required','email', Rule::unique('users')->ignore($id, 'id')],
            'password' => ['nullable','min:4'],
            'confirme' => ['nullable','min:4'],
            'telephone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','between:9,18'],
            'nom' => ['required','string', 'min:2'],
            'niveau' => ['integer'],
            'droit_eval' => ['nullable'],
            'evaluateur'=> ['nullable'],
            'photo'=> ['image','mimes:jpeg,png,gif,jpg,svg']
        ];
    }
}

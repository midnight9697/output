<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'email' => ['required'],
            // 'password' => ['required', Password::min(8), 'confirmed'],
            'firstname' => 'required',
            'lastname' => 'required',
            'division' => 'required',
            'section' => 'required',
            'position' => 'required'
        ];
    }
}

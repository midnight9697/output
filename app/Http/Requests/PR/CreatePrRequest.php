<?php

namespace App\Http\Requests\PR;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'entity_name' => 'required',
            // 'fund_cluster' => 'required',
            // 'office' => 'required',
            // 'responsibility_center_code' => 'required',
        ];
    }
}

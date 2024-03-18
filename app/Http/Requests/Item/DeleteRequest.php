<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * This method is called automatically by Laravel just before the validation process occurs.
     * Use this method to prepare the data for validation, such as converting data types,
     * trimming whitespace, or performing any other necessary data manipulations.
     *
     * @return void
     */
        public function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:items,id']
        ];
    }
}

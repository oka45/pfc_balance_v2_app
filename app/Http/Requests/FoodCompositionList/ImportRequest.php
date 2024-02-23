<?php

namespace App\Http\Requests\FoodCompositionList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use App\Servies\FoodCompositionListService;

use Illuminate\Support\Facades\Log;

class ImportRequest extends FormRequest
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
        return [
            'food_composition_list_file' => [
                'required',
                File::types('xlsx')->max('5mb')
            ]
        ];
    }

    public function food_composition_list_file()
    {
        return $this->input('food_composition_list_file');
    }
}

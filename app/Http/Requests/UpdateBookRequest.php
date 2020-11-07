<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        return [
            //
            'title' => [
                'required',
                'string',
                Rule::unique('books')->ignore($this->title, 'title'),
            ],
            'author' => 'required|string',
            'publisher' => 'required|string',
            'date_published' => 'required|date|before_or_equal:'.date('Y-m-d'),
            'description' => [
                'required',
                'string',
                Rule::unique('books')->ignore($this->description, 'description'),
            ],
            'front_cover' => 'sometimes|nullable|required|image|mimes:png,jpg,jpeg|max:2000',
            'file' => 'sometimes|nullable|required|file|mimes:pdf,docx,epub,txt',
        ];
    }
}
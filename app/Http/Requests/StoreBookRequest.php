<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|unique:books|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'date_published' => 'required|date|before_or_equal:'.date('Y-m-d'),
            'description' => 'required|unique:books|string',
            'front_cover' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'file' => 'required|file|mimes:pdf,docx,epub,txt',
        ];
    }
}
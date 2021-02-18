<?php

namespace App\Http\Requests;

use App\Models\TenderCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTenderCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tender_category_create');
    }

    public function rules()
    {
        return [
            'category_code' => [
                'string',
                'min:2',
                'max:20',
                'required',
                'unique:tender_categories',
            ],
            'category_name' => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'description'   => [
                'string',
                'nullable',
            ],
        ];
    }
}

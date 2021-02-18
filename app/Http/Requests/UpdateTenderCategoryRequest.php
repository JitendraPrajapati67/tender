<?php

namespace App\Http\Requests;

use App\Models\TenderCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTenderCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tender_category_edit');
    }

    public function rules()
    {
        return [
            'category_code' => [
                'string',
                'min:2',
                'max:20',
                'required',
                'unique:tender_categories,category_code,' . request()->route('tender_category')->id,
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

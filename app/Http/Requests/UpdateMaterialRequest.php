<?php

namespace App\Http\Requests;

use App\Models\Material;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaterialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_edit');
    }

    public function rules()
    {
        return [
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

<?php

namespace App\Http\Requests;

use App\Models\TenderCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTenderCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tender_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tender_categories,id',
        ];
    }
}
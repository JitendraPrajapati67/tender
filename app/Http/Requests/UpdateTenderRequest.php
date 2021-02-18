<?php

namespace App\Http\Requests;

use App\Models\TenderCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTenderRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('tender_category_edit');
    // }

    public function rules()
    {
        return [
            'tender_reference_no' => [
                'string',
                'max:20',
                'required',
            ],
            'tender_title' => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'tender_discription'   => [
                'string',
                'nullable',
            ],
            'open_date'   => [
                'string',
                'nullable',
            ],
            'close_date'   => [
                'string',
                'nullable',
            ],
            'status'   => [
                'string',
                'nullable',
            ],
            'type'   => [
                'string',
                'nullable',
            ],
            
        ];
    }
}

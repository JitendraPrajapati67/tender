<?php

namespace App\Http\Requests;

use App\Models\BidderManager;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBidderManagerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bidder_manager_edit');
    }

    public function rules()
    {
        return [
            'supplier_name'          => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'company_reg_number'     => [
                'string',
                'min:4',
                'max:50',
                'required',
            ],
            'company_contact_person' => [
                'string',
                'min:3',
                'max:25',
                'required',
            ],
            'email'                  => [
                'string',
                'min:3',
                'required',
                'unique:bidder_managers,email,' . request()->route('bidder_manager')->id,
            ],
            'mobile'                 => [
                'string',
                'min:8',
                'max:15',
                'required',
                'unique:bidder_managers,mobile,' . request()->route('bidder_manager')->id,
            ],
            'address'                => [
                'required',
            ],
            'status'                 => [
                'required',
            ],
        ];
    }
}

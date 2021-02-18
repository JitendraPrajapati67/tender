<?php

namespace App\Http\Requests;

use App\Models\BidManager;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBidManagerRequest extends FormRequest
{

    public function rules()
    {
        return [
            'tender_id'          => [
                'string',
                'max:50',
                'required',
            ],
            'price'     => [
                'string',
                'max:50',
                'required',
            ],
            'discription' => [
                'string',
                'max:25',
                'required',
            ],
            
        ];
    }
}



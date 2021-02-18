<?php

namespace App\Http\Requests;

use App\Models\BidderManager;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBidderManagerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bidder_manager_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bidder_managers,id',
        ];
    }
}

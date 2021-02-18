<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'required',
            ],
            'email'        => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'username'     => [
                'string',
                'min:4',
                'max:25',
                'required',
                'unique:users,username,' . request()->route('user')->id,
            ],
            'contact_no_1' => [
                'string',
                'min:6',
                'max:15',
                'nullable',
            ],
            'contact_no_2' => [
                'string',
                'min:6',
                'max:15',
                'nullable',
            ],
            'roles.*'      => [
                'integer',
            ],
            'roles'        => [
                'required',
                'array',
            ],
            'status'       => [
                'required',
            ],
        ];
    }
}

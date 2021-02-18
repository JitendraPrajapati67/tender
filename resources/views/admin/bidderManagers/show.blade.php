@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bidderManager.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bidder-managers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.id') }}
                        </th>
                        <td>
                            {{ $bidderManager->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.supplier_name') }}
                        </th>
                        <td>
                            {{ $bidderManager->supplier_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.company_reg_number') }}
                        </th>
                        <td>
                            {{ $bidderManager->company_reg_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.company_contact_person') }}
                        </th>
                        <td>
                            {{ $bidderManager->company_contact_person }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.email') }}
                        </th>
                        <td>
                            {{ $bidderManager->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.mobile') }}
                        </th>
                        <td>
                            {{ $bidderManager->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.address') }}
                        </th>
                        <td>
                            {{ $bidderManager->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bidderManager.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\BidderManager::STATUS_SELECT[$bidderManager->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bidder-managers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

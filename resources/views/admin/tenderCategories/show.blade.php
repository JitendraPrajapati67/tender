@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenderCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tender-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $tenderCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderCategory.fields.category_code') }}
                        </th>
                        <td>
                            {{ $tenderCategory->category_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderCategory.fields.parent_id') }}
                        </th>
                        <td>
                             {{ $tenderCategory->parent->category_name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderCategory.fields.category_name') }}
                        </th>
                        <td>
                            {{ $tenderCategory->category_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $tenderCategory->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tender-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

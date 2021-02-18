@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenderManagement.title') }}
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
                            {{ trans('cruds.tenderManagement.fields.tender_reference_no') }}
                        </th>
                        <td>
                            {{ $tender->tender_reference_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.tender_title') }}
                        </th>
                        <td>
                            {{ $tender->tender_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.description') }}
                        </th>
                        <td>
                             {{ $tender->description?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.open_date') }}
                        </th>
                        <td>
                            {{ $tender->open_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.close_date') }}
                        </th>
                        <td>
                            {{ $tender->close_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.status') }}
                        </th>
                        <td>
                            {{ $tender->status }}
                        </td>
                    </tr>
                     <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.type') }}
                        </th>
                        <td>
                            {{ $tender->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.created_by') }}
                        </th>
                        <td>
                            {{ $tender->created_by }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class='form-group'>
                @foreach($tenderMapDocument as $key => $label)
                    <a href='{{ route('bid.getDownload',$label->document ) }}' class="btn btn-default btn-sm"><i class="fa fa-download"></i> {{ $label->document_orignal_name }}</a>
                @endforeach
            </div>
            
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bidManagement.title') }}
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
                            {{ trans('cruds.bidManagement.fields.price') }}
                        </th>
                        <td>
                            {{ $bid->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.bidManagement.fields.description') }}
                        </th>
                        <td>
                            {{ $bid->discription }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{ trans('cruds.bidManagement.fields.document') }}
            <div class='form-group'>
               @foreach($tenderMapDocument as $key => $label)
                    <a href='{{ route('bid.getDownload',$label->document ) }}' class="btn btn-default btn-sm"><i class="fa fa-download"></i> {{ $label->document_orignal_name }}</a>
                @endforeach
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tender-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

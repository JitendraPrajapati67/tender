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
                            @if($tender->status == 0)
                              Inactive
                            @else
                              Active
                            @endif
                            
                        </td>
                    </tr>
                     <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.type') }}
                        </th>
                        <td>
                            @if($tender->type ==0)
                                Free
                            @else
                                Paid
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderManagement.fields.created_by') }}
                        </th>
                        <td>
                            @if($tender->created_by == 1)
                                Admin
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class='form-group'>
            <label class="" style="margin-left: 25px;">Materials:-</label>  
              @foreach($materials as $key => $label)
                <label class="" style="margin-left: 25px;">{{ $label->category_name }}</label>
              @endforeach  
            </div>
            <div class='form-group'>
                @foreach($tenderMapDocument as $key => $label)
                    <button class="btn btn-default btn-sm"><i class="fa fa-download"></i> {{ $label->document_orignal_name }}</button>
                @endforeach
            </div>
            
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bidManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bidManagement.fields.id') }}
                        </th>
                         <th>
                            {{ trans('cruds.bidManagement.fields.price') }}
                        </th>

                         <th>
                            {{ trans('cruds.bidManagement.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.bidManagement.fields.created_at') }}
                        </th>

                        <th>
                            {{ trans('cruds.bidManagement.fields.updated_at') }}
                        </th>
                        <th>
                            Action
                        </th>
      
                    </tr>
                </thead>
                <tbody>
                    @foreach($bids as $key => $bid)
                        <tr data-entry-id="{{ $bid->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bid->id ?? '' }}
                            </td>
                            <td>
                                {{ $bid->price ?? '-' }}
                            </td>
                            <td>
                                {{ $bid->discription ?? '' }}
                            </td>

                            <td>
                               {{ date('Y-m-d', strtotime($bid->created_at)) ?? '' }}
                            </td>

                            <td>
                               {{ date('Y-m-d', strtotime($bid->updated_at)) ?? '' }}
                            </td>

                            <td>
                                @can('tender_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('bid.show', $bid->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('tender_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('bid.edit', $bid->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
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

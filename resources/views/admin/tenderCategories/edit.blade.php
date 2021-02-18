@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tenderCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tender-categories.update", [$tenderCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_code">{{ trans('cruds.tenderCategory.fields.category_code') }}</label>
                <input class="form-control {{ $errors->has('category_code') ? 'is-invalid' : '' }}" type="text" name="category_code" id="category_code" value="{{ old('category_code', $tenderCategory->category_code) }}" required>
                @if($errors->has('category_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_code') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.tenderCategory.fields.parent_id') }}</label>
                <select class="form-control {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id" required>
                    <option value disabled {{ old('parent_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($parentCategory as $key => $label)
                        <option value="{{ $label->id }}" {{ old('parent_id', $tenderCategory->parent_id) === $label->id ? 'selected' : '' }}>{{ $label->category_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_id') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="category_name">{{ trans('cruds.tenderCategory.fields.category_name') }}</label>
                <input class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" type="text" name="category_name" id="category_name" value="{{ old('category_name', $tenderCategory->category_name) }}" required>
                @if($errors->has('category_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_name') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.tenderCategory.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $tenderCategory->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.material.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.materials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.material.fields.parent') }}</label>
                <select class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent" id="parent">
                    <option value disabled {{ old('parent', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($parentCategory as $key => $label)
                        <option value="{{ $label->id }}" {{ old('parent', '') === (string) $label->id ? 'selected' : '' }}>{{ $label->category_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_name">{{ trans('cruds.material.fields.category_name') }}</label>
                <input class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" type="text" name="category_name" id="category_name" value="{{ old('category_name', '') }}" required>
                @if($errors->has('category_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.category_name_helper') }}</span>
            </div>
       
             <div class="form-group">
                <label for="description">{{ trans('cruds.material.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.material.fields.description_helper') }}</span>
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

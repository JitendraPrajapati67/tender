@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bidderManager.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bidder-managers.update", [$bidderManager->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="supplier_name">{{ trans('cruds.bidderManager.fields.supplier_name') }}</label>
                <input class="form-control {{ $errors->has('supplier_name') ? 'is-invalid' : '' }}" type="text" name="supplier_name" id="supplier_name" value="{{ old('supplier_name', $bidderManager->supplier_name) }}" required>
                @if($errors->has('supplier_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier_name') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="company_reg_number">{{ trans('cruds.bidderManager.fields.company_reg_number') }}</label>
                <input class="form-control {{ $errors->has('company_reg_number') ? 'is-invalid' : '' }}" type="text" name="company_reg_number" id="company_reg_number" value="{{ old('company_reg_number', $bidderManager->company_reg_number) }}" required>
                @if($errors->has('company_reg_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_reg_number') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="company_contact_person">{{ trans('cruds.bidderManager.fields.company_contact_person') }}</label>
                <input class="form-control {{ $errors->has('company_contact_person') ? 'is-invalid' : '' }}" type="text" name="company_contact_person" id="company_contact_person" value="{{ old('company_contact_person', $bidderManager->company_contact_person) }}" required>
                @if($errors->has('company_contact_person'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_contact_person') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.bidderManager.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $bidderManager->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="mobile">{{ trans('cruds.bidderManager.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $bidderManager->mobile) }}" required>
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.bidderManager.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address', $bidderManager->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                
            </div>
             <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $bidderManager->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bidderManager.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\BidderManager::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $bidderManager->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
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

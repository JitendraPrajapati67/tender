@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <h1>{{ trans('panel.site_title') }}</h1>
                    <p class="text-muted">{{ trans('global.register') }}</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-address-book fa-fw"></i>
                            </span>
                        </div>
                        <input type="number" name="mobile" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" required placeholder="Enter mobile" value="{{ old('mobile', null) }}">
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-map-signs fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" required placeholder="Enter address" value="{{ old('address', null) }}">
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="supplier_name" class="form-control{{ $errors->has('supplier_name') ? ' is-invalid' : '' }}" required placeholder="Enter supplier name" value="{{ old('supplier_name', null) }}">
                        @if($errors->has('supplier_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supplier_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-adjust fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="company_reg_number" class="form-control{{ $errors->has('company_reg_number') ? ' is-invalid' : '' }}" required placeholder="Enter company register number" value="{{ old('company_reg_number', null) }}">
                        @if($errors->has('company_reg_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company_reg_number') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-map-signs fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="company_contact_person" class="form-control{{ $errors->has('company_contact_person') ? ' is-invalid' : '' }}" required placeholder="Enter company contact person" value="{{ old('company_contact_person', null) }}">
                        @if($errors->has('company_contact_person'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company_contact_person') }}
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-block btn-primary">
                        {{ trans('global.register') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

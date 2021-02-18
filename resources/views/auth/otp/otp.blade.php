@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>{{ trans('panel.site_title') }}</h1>

                <p class="text-muted">OTP Verification</p>
                @include('partials.notification')

                <form method="POST" action="{{ route('auth.otp.verification') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="mobile" name="mobile" type="hidden" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" required autocomplete="mobile" autofocus placeholder="Enter mobile number" value="{{ old('mobile', $user->mobile) }}">

                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <input id="otp" name="otp" type="number" class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" required autocomplete="otp" autofocus placeholder="Enter otp" value="{{ old('otp', null) }}">
                        @if($errors->has('otp'))
                            <div class="invalid-feedback">
                                {{ $errors->first('otp') }}
                            </div>
                        @endif

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">
                                Submit
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-link px-0" href="{{ route('auth.otp.resend',$user->mobile) }}">
                                Resend OTP.
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

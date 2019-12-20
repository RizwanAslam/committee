@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <div class="name-input">
                                            <input class="form-control  {{ $errors->has('first_name') ? 'has-error' : '' }}"
                                                   name="first_name" id="first_name" placeholder="First Name"
                                                   value="{{old('first_name')}}" type="text">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <div class="name-input">
                                            <input class="form-control {{ $errors->has('last_name') ? 'has-error' : '' }}"
                                                   name="last_name" id="last_name" placeholder="Last Name" type="text"
                                                   value="{{old('last_name')}}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="email-input">
                                            <input class="form-control  {{ $errors->has('email') ? 'has-error' : '' }}"
                                                   name="email" id="email" placeholder="Email" value="{{old('email')}}"
                                                   type="text">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cnic">Cnic</label>
                                        <div class="cnic-input">
                                            <input class="form-control {{ $errors->has('cnic') ? 'has-error' : '' }}"
                                                   name="cnic" id="cnic" data-inputmask="'mask': '99999-9999999-9'"
                                                   placeholder="XXXXX-XXXXXXX-X" type="text" value="{{old('cnic')}}">
                                        </div>
                                        <span class="text-danger">{{ $errors->first('cnic') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label text-md-right">{{ __('Password') }}</label>
                                        <div class="email-input">
                                            <input id="password" type="password" placeholder="Password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="new-password">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password-confirm"
                                               class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                        <div class="cnic-input">
                                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control  {{ $errors->has('address') ? 'has-error' : '' }}"
                                       name="address" id="address" placeholder="Address" type="text"
                                       value="{{old('address')}}">
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

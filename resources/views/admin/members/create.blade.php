@extends('admin.layout.app')
@section('title')
    Create Member
@endsection
@section('style')
    .has-error {
    border: 2px solid #e74c3c;
    }
@endsection
@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item"><span>Laptop with retina screen</span></li>
    </ul>
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" method="post" action="{{route('members.store')}}">
                            @csrf
                            <h5 class="form-header">Create Member</h5>
                            <div>
                                <hr/>
                            </div>
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
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control  {{ $errors->has('address') ? 'has-error' : '' }}"
                                       name="address" id="address" placeholder="Address" type="text"
                                       value="{{old('address')}}">
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary" style="cursor: pointer">Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#cnic").inputmask();
    </script>
@endsection

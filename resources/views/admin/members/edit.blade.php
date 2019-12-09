@extends('admin.layout.app')
@section('title')
   Edit Member
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
                        <form id="memberValidate" method="post" action="{{route('members.update',$member->id)}}">
                            {{method_field('PUT')}}
                            @csrf
                            <h5 class="form-header">Edit Member</h5>
                            <div>
                                <hr/>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control {{ $errors->has('first_name') ? 'has-error' : '' }}"
                                               name="first_name" id="first_name" value="{{$member->first_name}}"
                                               type="text">
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control {{ $errors->has('last_name') ? 'has-error' : '' }}"
                                               name="last_name" id="last_name" value="{{$member->last_name}}"
                                               type="text">
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" value="{{$member->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cnic">Cnic</label>
                                        <input class="form-control" value="{{$member->cnic}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control {{ $errors->has('address') ? 'has-error' : '' }}"
                                       name="address" id="address" value="{{$member->address}}" type="text">
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" style="cursor: pointer" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

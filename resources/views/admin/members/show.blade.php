@extends('admin.layout.app')
@section('title')
    Show Member
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
                        <form id="formValidate">
                            @csrf
                            <h5 class="form-header">Show Member</h5>
                            <div>
                                <hr/>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" value="{{$member->first_name}}" disabled
                                               type="text">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" value="{{$member->last_name}}" disabled
                                               type="text">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" value="{{$member->email}}" type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cnic">Cnic</label>
                                        <input class="form-control" value="{{$member->cnic}}" disabled type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" value="{{$member->address}}" disabled type="text">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>

                            <div class="">
                                <a role="button" class="btn btn-primary" href="{{route('members.index')}}"
                                   style="cursor: pointer">Back
                                </a>
                            </div>
                        </form>
                        <hr/>
                        <div class="table-responsive">
                            <table id="member-committees" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                <tr>
                                    <th>Committee Name</th>
                                    <th>Member Amount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($member->committees as $committee)
                                    <tr>
                                        <td>{{ $committee->name }}</td>
                                        <td>{{ $committee->amount }}</td>
                                        <td>
                                            <a href="{{route('member-details.index',[$committee->pivot->committee_id,$committee->pivot->member_id])}}"
                                               role="button" class="btn btn-primary btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
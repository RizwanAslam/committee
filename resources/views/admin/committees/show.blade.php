@extends('admin.layout.app')
@section('title')
    Show Committee
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
                            <h5 class="form-header">Show Committee</h5>
                            <div>
                                <hr/>
                            </div>
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input class="form-control" value="{{$committee->name}}" disabled type="text">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="total_members">Total Members</label>
                                <input class="form-control" value="{{$committee->total_members}}" disabled type="text">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <div class="date-input">
                                            <input class="single-daterange form-control"
                                                   value="{{\Carbon\Carbon::parse($committee->start_date)->format('m/d/y')}}"
                                                   type="text" disabled>
                                        </div>
                                        <div class="help-block form-text text-muted form-control-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <div class="date-input">
                                            <input class="single-daterange form-control"
                                                   value="{{\Carbon\Carbon::parse($committee->end_date)->format('m/d/y')}}"
                                                   type="text" disabled>
                                        </div>
                                        <div class="help-block form-text with-errors text-muted form-control-feedback">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="duration">Duration</label>
                                        <input class="form-control" value="{{$committee->duration}}" type="text"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input class="form-control" value="{{$committee->amount}}" disabled type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="withDraw_amount">Withdraw Amount</label>
                                <input class="form-control" value="{{$committee->withDraw_amount}}" disabled
                                       type="text">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>

                            <div class="">
                                <a role="button" class="btn btn-primary" href="{{route('committees.index')}}"
                                   style="cursor: pointer">Back
                                </a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="committee-members" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Quantity</th>
                                    <th>Member Amount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->pivot->quantity }}</td>
                                        <td>{{ $member->pivot->amount }}</td>

                                        <td>
                                            @if($member->pivot->status=='paid')
                                                <button type="button" class="btn" disabled>

                                                    {{\Carbon\Carbon::parse($member->pivot->monthly_withdraw_date)->format('m/d/Y')}}
                                                    <i class="icon-feather-check"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('pays.index',[$committee->id,$member->id,$member->pivot->id])}}"
                                                   role="button" class="btn btn-primary btn-sm">Pay</a>
                                            @endif
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
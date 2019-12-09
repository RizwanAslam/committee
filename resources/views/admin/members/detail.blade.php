@extends('admin.layout.app')
@section('title')
    Member Detail
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
                        <h5 class="form-header">Detail</h5>
                        <hr/>
                        <div class="table-responsive">
                            <table id="member-committees" width="100%" class="table table-lightfont">
                                <thead>
                                <tr>
                                    <th>Committee Name</th>
                                    <th>Member Name</th>
                                    <th>Member Amount</th>
                                    <th>Monthly Paid Status</th>
                                    <th>Member Withdraw Amount</th>
                                    <th>Member Withdraw Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>{{ $committee->name }}</td>
                                    <td>{{ $member->fullname }}</td>
                                    <td>{{ $committee->amount }}</td>
                                    <td>
                                        @if($member->pivot->status=='paid')
                                            <span class="badge badge-success">True</span>
                                        @else
                                            <span class="badge badge-danger">False</span>
                                        @endif
                                    </td>
                                    <td>{{ $committee->withDraw_amount}}</td>

                                    <td>
                                        @if($member->pivot->withdraw_date!==null)
                                            {{\Carbon\Carbon::parse($member->pivot->withdraw_date)->format('m-d-y')}}
                                        @else
                                            N/A
                                        @endif
                                    </td>


                                </tr>
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
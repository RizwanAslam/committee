@extends('admin.layout.app')
@section('title')
    Pay
@endsection
@section('style')
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
                        <form id="payForm" method="post" action="{{route('pays.store')}}">
                            @csrf
                            <h5 class="form-header">Pay</h5>
                            <div>
                                <hr/>
                            </div>

                            <input type="hidden" name="member_id" value="{{request()->route('memberId')}}">
                            <input type="hidden" name="committee_id" value="{{$committee->id}}">
                            <input type="hidden" name="id" value="{{$member->pivot->id}}">
                            <input type="hidden" name="status" value="paid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="committee_name">Name</label>
                                        <input class="form-control" value="{{$committee->name}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="member_quantity">Member Quantity</label>
                                        <input class="form-control" name="member_quantity"
                                               value="{{$member->pivot->quantity}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input class="form-control" value="{{Carbon\Carbon::now()->format('m/d/Y')}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="member_amount">Amount</label>
                                        <input class="form-control" name="member_amount"
                                               value="{{$member->pivot->amount}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" style="cursor: pointer">Submit</button>
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

    </script>
@endsection

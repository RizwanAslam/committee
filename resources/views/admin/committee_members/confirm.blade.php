@extends('admin.layout.app')
@section('title')
    Confirm
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
                        <form id="payForm" method="post" action="{{route('committee-members.store')}}">
                            @csrf
                            <h5 class="form-header">Confirm</h5>
                            <div>
                                <hr/>
                            </div>
                            <input type="hidden" name="committee_id" value="{{$committee->id}}">
                            <input type="hidden" name="member_id" value="{{request()->route('memberId')}}">
                            <input type="hidden" name="id" value="{{$member->pivot->id}}">
                            <input type="hidden" name="form" value="confirm">
                            <input type="hidden" name="withdraw" value="1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" value="{{$member->full_name}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Member Quantity</label>
                                        <input class="form-control" value="{{$member->pivot->quantity}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" value="{{Carbon\Carbon::now()->format('m/d/Y')}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input class="form-control" value="{{$committee->withDraw_amount}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary"
                                        style="cursor: pointer">Submit
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

    </script>
@endsection
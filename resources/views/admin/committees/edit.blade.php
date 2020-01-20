@extends('admin.layout.app')
@section('title')
    Edit Committee
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
                        <form id="formValidate" method="post" action="{{route('committees.update',$committee->id)}}">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="form-header">Edit Committee</h5>
                                </div>
                                <div class="col-md-4">
                                    <a role="button" href="{{ route('committee-members.create',$committee->id) }}"
                                       class="btn btn-success m-1" style="float:right;">Withdraw</a>
                                    <a href="{{ route('committees.show', $committee->id) }}" role="button"
                                       class="btn btn-success m-1" style="float:right;">Show</a>
                                </div>
                            </div>
                            {{method_field('PUT')}}
                            @csrf
                            <div>
                                <hr/>
                            </div>
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input class="form-control  {{ $errors->has('name') ? 'has-error' : '' }}"
                                       name="name" id="name" placeholder="Name" type="text"
                                       value="{{$committee->name}}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="total_members">Total Members</label>
                                <input class="form-control {{ $errors->has('total_members') ? 'has-error' : '' }}"
                                       id="total_members" placeholder="Total Members"
                                       type="text" value="{{$committee->total_members}}" disabled>
                                <span class="text-danger">{{ $errors->first('total_members') }}</span>
                                <div class="help-block form-text with-errors form-control-feedback"></div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <div class="date-input">
                                            <input
                                                class="form-control calculate-duration {{ $errors->has('start_date') ? 'has-error' : '' }}"
                                                name="start_date" id="start_date"
                                                value="{{\Carbon\Carbon::parse($committee->start_date)->format('m/d/y')}}"
                                                type="text" disabled="">
                                        </div>
                                        <div class="help-block form-text text-muted form-control-feedback">
                                            Pick From Calender
                                        </div>
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <div class="date-input">
                                            <input
                                                class="form-control calculate-duration {{ $errors->has('end_date') ? 'has-error' : '' }}"
                                                id="end_date" type="text"
                                                value="{{\Carbon\Carbon::parse($committee->end_date)->format('m/d/y')}}"
                                                disabled>
                                        </div>
                                        <div class="help-block form-text with-errors text-muted form-control-feedback">
                                            Pick From Calender
                                        </div>
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="duration">Duration</label>
                                        <input class="form-control {{ $errors->has('duration') ? 'has-error' : '' }}"
                                               name="duration" id="duration" value="{{$committee->duration}}"
                                               type="text"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}"
                                               id="amount" type="number" value="{{$committee->amount}}"
                                               oninput="calculateWithDrawAmount()" disabled>
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="withdraw-amount">Withdraw Amount</label>
                                <input class="form-control {{ $errors->has('withdraw-amount') ? 'has-error' : '' }}"
                                       name="withdraw-amount" id="withdraw_amount"
                                       value="{{$committee->withDraw_amount}}"
                                       type="text" readonly>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary" style="cursor: pointer">Update
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
        var date = new Date();
        $('#start_date').daterangepicker({
            "singleDatePicker": true,
            minDate: date,
        });


        $('#end_date').daterangepicker({
            "singleDatePicker": true,
            minDate: new Date(date.getTime() + 24 * 60 * 60 * 1000),
        });

        $('.calculate-duration').on('change', function (e) {
            var startDate = $("#start_date").val();
            var endDate = $("#end_date").val();
            var start = new Date(startDate);
            var end = new Date(endDate);
            var differenceInTime = end.getTime() - start.getTime();
            var differenceInDays = Math.round(differenceInTime / (1000 * 3600 * 24));
            document.getElementById("duration").value = differenceInDays + " days";
        });

        $('#total_members').on('blur', function (e) {
            calculateEndDate()
        });

        $('#start_date').on('blur', function (e) {
            calculateEndDate()
        });

        function calculateEndDate() {
            var currentDate = new Date($('#start_date').val());
            var endDate = new Date(currentDate.setMonth(currentDate.getMonth() + parseInt($("#total_members").val())));
            $("#end_date").val(endDate.getMonth() + parseInt(1) + '/' + endDate.getDate() + '/' + endDate.getFullYear());


            $('#end_date').daterangepicker({
                "singleDatePicker": true,
                minDate: new Date(new Date($("#start_date").val()).getTime() + 24 * 60 * 60 * 1000),
            });

        }

        function calculateWithDrawAmount() {
            var amount = $('#amount').val();
            amount = amount == "" ? 0 : amount;
            var totalMembers = $('#total_members').val();

            $('#withdraw_amount').val(totalMembers * amount);
        }
    </script>
@endsection


@extends('admin.layout.app')
@section('title')
    Committee
@endsection
@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item"><span>Laptop with retina screen</span></li>
    </ul>
    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="element-header">{{$committee->name}}</h5>
                    </div>
                    <div class="col--md-3" style="margin-left: 55px">
                    </div>
                </div>
                <div class="element-box">
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <b>Start date:</b>
                                <span>{{\Carbon\Carbon::parse($committee->start_date)->format('m/d/y')}}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <b>End date:</b>
                                <span>{{\Carbon\Carbon::parse($committee->end_date)->format('m/d/y')}}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <b>Duration:</b>
                                <span>{{$committee->duration}} months</span>
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="committee-report" width="100%" class="table table-striped table-lightfont">
                            <thead>
                            <tr>
                                <th>Members Name</th>
                                <th>Members Quantity</th>
                                <th>Members Amount</th>
                                <th>Members Withdraw Date</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#committee-report').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('committee-reports.datatable',$committee->id)}}",
                "columns": [
                    {data: 'full_name'},
                    {data: 'quantity'},
                    {data: 'amount'},
                    {data: 'withdraw_date'},

                ]
            });
        });
    </script>
@endsection
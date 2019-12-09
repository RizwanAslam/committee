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
                        <h5 class="element-header">Search</h5>
                    </div>
                    <div class="col--md-3" style="margin-left: 55px">
                    </div>
                </div>
                <div class="element-box">
                    <div>
                        <div class="table-responsive">
                            <table id="committee-datatable" width="100%"
                                   class="table table-striped table-lightfont">
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Committee Name</th>--}}
                                    {{--<th>Total Members</th>--}}
                                    {{--<th>Duration</th>--}}
                                    {{--<th>Start Date</th>--}}
                                    {{--<th>End Date</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($searchedCommittees as $searchedCommittee)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{$searchedCommittee->name}}</td>--}}
                                        {{--<td>{{$searchedCommittee->total_members}}</td>--}}
                                        {{--<td>{{$searchedCommittee->duration}} months</td>--}}
                                        {{--<td>{{\Carbon\Carbon::parse($searchedCommittee->start_date)->format('m/d/y')}}</td>--}}
                                        {{--<td>{{\Carbon\Carbon::parse($searchedCommittee->end_date)->format('m/d/y')}}</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
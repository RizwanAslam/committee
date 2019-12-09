@extends('admin.layout.app')
@section('title')
    Committees
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
                    <div class="col-md-10">
                        <h5 class="element-header">Committee List</h5>
                    </div>
                    <div class="col--md-2">
                        <a role="button" href="{{ route('committees.create') }}" id="add" class="btn btn-success">Add
                            New
                            Committee</a>
                    </div>
                </div>
                <div class="element-box">
                    <div class="table-responsive">
                        <table id="committee-datatable" width="100%" class="table table-striped table-lightfont">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Members</th>
                                <th>WithDraw Amount</th>
                                <th>Amount</th>
                                <th>Actions</th>
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
            $('#committee-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('committees.datatable')}}",
                "columns": [
                    {data: 'name'},
                    {data: 'start_date'},
                    {data: 'end_date'},
                    {data: 'duration'},
                    {data: 'total_members'},
                    {data: 'withDraw_amount'},
                    {data: 'amount'},
                    {data: 'actions'},
                ]
            });
        });
    </script>
@endsection
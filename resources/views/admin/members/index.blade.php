@extends('admin.layout.app')
@section('title')
    Members
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
                        <h5 class="element-header">Member List</h5>
                    </div>
                    <div class="col--md-2" style="margin-left: 15px">
                        <a role="button" href="{{ route('members.create') }}" id="add" class="btn btn-success">Add New
                            Member</a>
                    </div>
                </div>
                <div class="element-box">
                    <div class="table-responsive">
                        <table id="member-datatable" width="100%" class="table table-striped table-lightfont">
                            <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Cnic</th>
                                <th>Address</th>
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
            $('#member-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('members.datatable')}}",
                "columns": [
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'email'},
                    {data: 'cnic'},
                    {data: 'address'},
                    {data: 'actions'},
                ]
            });
        });
    </script>
@endsection
@extends('admin.layout.app')
@section('title')
    Search Committees
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
                        <h5 class="element-header">Report</h5>
                    </div>
                    <div class="col--md-3" style="margin-left: 55px">
                    </div>
                </div>
                <div class="element-box">
                    @if (session('not-found'))
                        <div class="alert alert-danger">
                            {{ session('not-found') }}
                        </div>
                    @endif
                    <h5>Search Box</h5>
                    <hr>

                    <search-component></search-component>

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
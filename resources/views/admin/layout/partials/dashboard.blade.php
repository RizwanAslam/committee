@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item"><span>Laptop with retina screen</span></li>
    </ul>
    <div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
    <div class="content-i">
        <div class="content-box">
            <div class="element-content">
                <div class="row">
                    <div class="col-sm-6"><a class="element-box el-tablo" href="#">
                            <div class="label">Total Committees</div>
                            <div class="value">{{$committees->count()}}</div>
                        </a></div>
                    <div class="col-sm-6"><a class="element-box el-tablo" href="#">
                            <div class="label">Total Members</div>
                            <div class="value">{{$members->count()}}</div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="element-box">
                                <div>
                                    <table id="committee-datatable" width="100%"
                                           class="table table-borderless table-lightfont">
                                        <thead>
                                        <tr>
                                            <th>Committee Name</th>
                                            <th>Total Members</th>
                                            <th>Duration</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($committees as $committee)
                                            <tr>
                                                <td>{{$committee->name}}</td>
                                                <td>{{$committee->total_members}}</td>
                                                <td>{{$committee->duration}} months</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="element-box">
                                <div>
                                    <table id="committee-datatable" width="100%"
                                           class="table table-borderless table-lightfont">
                                        <thead>
                                        <tr>
                                            <th>Member First Name</th>
                                            <th>Member Last Name</th>
                                            <th>Member Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($members as $member)
                                            <tr>
                                                <td>{{$member->first_name}}</td>
                                                <td>{{$member->last_name}}</td>
                                                <td>{{$member->address}}</td>
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
        </div>

        <div class="content-panel">
            <div class="content-panel-close"><i class="os-icon os-icon-close"></i></div>
            <div class="element-wrapper"><h6 class="element-header">Quick Links</h6>
                <div class="element-box-tp">
                    <div class="el-buttons-list full-width"><a class="btn btn-white btn-sm" href="#"><i
                                    class="os-icon os-icon-delivery-box-2"></i><span>Create New Product</span></a><a
                                class="btn btn-white btn-sm" href="#"><i
                                    class="os-icon os-icon-window-content"></i><span>Customer Comments</span></a><a
                                class="btn btn-white btn-sm" href="#"><i
                                    class="os-icon os-icon-wallet-loaded"></i><span>Store Settings</span></a>
                    </div>
                </div>
            </div>
            <div class="element-wrapper"><h6 class="element-header">Support Agents</h6>
                <div class="element-box-tp">
                    <div class="profile-tile"><a class="profile-tile-box" href="#">
                            <div class="pt-avatar-w"><img alt="" src="{{asset('assets/img/avatar1.jpg')}}"></div>
                            <div class="pt-user-name">Mark Parson</div>
                        </a>
                        <div class="profile-tile-meta">
                            <ul>
                                <li>Last Login:<strong>Online Now</strong></li>
                                <li>Tickets:<strong>12</strong></li>
                                <li>Response Time:<strong>2 hours</strong></li>
                            </ul>
                            <div class="pt-btn"><a class="btn btn-success btn-sm" href="#">Send
                                    Message</a></div>
                        </div>
                    </div>
                    <div class="profile-tile"><a class="profile-tile-box" href="#">
                            <div class="pt-avatar-w"><img alt="" src="{{asset('assets/img/avatar3.jpg')}}"></div>
                            <div class="pt-user-name">John Mayers</div>
                        </a>
                        <div class="profile-tile-meta">
                            <ul>
                                <li>Last Login:<strong>Online Now</strong></li>
                                <li>Tickets:<strong>9</strong></li>
                                <li>Response Time:<strong>3 hours</strong></li>
                            </ul>
                            <div class="pt-btn"><a class="btn btn-secondary btn-sm" href="#">Send
                                    Message</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('body').addClass('with-content-panel');
            $('.all-wrapper').addClass('with-side-panel');
        });
    </script>
@endsection
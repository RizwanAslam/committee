@extends('admin.layout.app')
@section('title')
    Show Committee
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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="form-header">Monthly Details</h5>
                                    </div>
                                    <div class="col-md-6 p-1">
                                        <form method="POST">
                                            <input
                                                class="form-control {{ $errors->has('search-input') ? 'has-error' : '' }}"
                                                name="search-input" id="search-input" placeholder="Search..."
                                                type="text" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a role="button" href="{{ route('committee-members.create',$committee->id) }}"
                                   class="btn btn-success m-1" style="float:right;">Withdraw</a>
                                <a href="{{ route('committees.edit', $committee->id) }}" role="button"
                                   class="btn btn-success m-1" style="float:right;">Edit</a>
                            </div>
                        </div>

                        <div>
                            <hr/>
                        </div>
                        <div class="table-responsive">
                            <table id="committee-members" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Quantity</th>
                                    <th>Member Amount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->pivot->quantity }}</td>
                                        <td>{{ $member->pivot->amount }}</td>

                                        <td>
                                            @if($member->pivot->status=='paid')
                                                <button type="button" class="btn" disabled>

                                                    {{\Carbon\Carbon::parse($member->pivot->monthly_withdraw_date)->format('m/d/Y')}}
                                                    <i class="icon-feather-check"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('pays.index',[$committee->id,$member->id,$member->pivot->id])}}"
                                                   role="button" class="btn btn-primary btn-sm">Pay</a>
                                            @endif
                                        </td>
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#search-input").flatpickr({
                dateFormat: "M Y"
            });

            $("#search-input").ready(function () {
                var committee_id = '{{ $committee->id}}';
                var value = $("#search-input").val();
                $.ajax({
                    url: "/committees/" + committee_id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'POST',
                        'data': {value: value},
                    },
                    success: function (data) {
                        //
                    }
                });
            });
        });

    </script>
@endsection

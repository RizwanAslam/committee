@extends('admin.layout.app')
@section('title')
    Create committee Members
@endsection
@section('style')
    .has-error {
    border: 2px solid #e74c3c;
    }
    th[draggable] a, th[draggable] { cursor: move; }

    th[draggable] a:hover, th[draggable] a {
    display: block;
    text-decoration: none;
    color: #333333;
    }

    .drag {
    background-color: rgba(0, 0, 0, 0.25);
    opacity: 0.25
    }

    .dnd-drag { opacity: 0.25 }

    .over { background-color: rgba(0, 0, 255, 0.35); }
    select{
    padding:0px 5px 0px 5px !important;
    }
    table {
    border-collapse: collapse;
    }

    td, th {
    background: #fff;
    border-width: 0;
    border-bottom: 1px solid #B8B8B8;
    font-weight: normal !important;
    padding: 15px;
    text-align: left;
    vertical-align: middle;
    }

    tr.even {
    td, th {
    background: #f1f1f1;
    }
    }

    thead, tfoot {
    text-transform: uppercase;

    th {
    background: #ccc;
    }
    }

    body {
    color: #111;
    font-size: 16px;
    font-family: sans-serif;
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
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="form-header">Create <b style="color: green">{{ $committee->name}}</b> Committee Members</h5>
                            </div>
                            <div class="col-md-4">
                                <a role="button" href="{{ route('committees.show',$committee->id) }}"
                                   class="btn btn-success m-1" style="float:right;">Show</a>
                                <a href="{{ route('committees.edit', $committee->id) }}" role="button"
                                   class="btn btn-success m-1" style="float:right;">Edit</a>
                            </div>
                        </div>
                        <form id="formValidate" method="post" action="{{route('committee-members.store')}}">
                            @csrf
                            <input type="hidden" id="committee_id" name="committee_id" value="{{ $committee->id}}">
                            <input type="hidden" id="quantity" name="quantity" value="1">
                            <div>
                                <hr/>
                            </div>
                            @if (session('danger'))
                                <div class="alert alert-danger">
                                    {{ session('danger') }}
                                </div>
                            @endif
                            @if (session('Already-Shuffled'))
                                <div class="alert alert-danger">
                                    {{ session('Already-Shuffled') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="member_id">Select Members</label>
                                        <div class="name-input">
                                            <select name="member_id" id="member_id"
                                                    class="form-control {{ $errors->has('member_id') ? 'has-error' : '' }}">
                                                <option value="" disabled selected>Choose ...</option>
                                                @foreach($members as $key => $member)
                                                    <option
                                                        value="{{ $member->id }}">{{ $member->first_name}} {{ $member->last_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" value="submit" name="submit" class="btn btn-primary"
                                        style="cursor: pointer">Add Member
                                </button>
                                @if($committee->members->count()==$committee->total_members)
                                    <button type="submit" value="withdraw" name="withdraw" class="btn btn-success"
                                            style="cursor: pointer">Shuffle
                                    </button>
                                @endif
                            </div>
                        </form>

                        <hr>
                        @include('admin.committee_members.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

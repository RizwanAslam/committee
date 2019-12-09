<div class="table-responsive" id="drag-drop">
    <table id="drag_drop" width="100%" class="table table-striped table-lightfont">
        <thead>
        <tr>
            <th>Member Name</th>
            <th>Quantity</th>
            <th>Withdraw status</th>
            <th>Withdraw Month</th>
            <th>Withdraw Date</th>
            <th>Withdraw order</th>
            <th>Click to Pay</th>
        </tr>
        </thead>
        <tbody class="" id="sortable">
        @foreach($committee->members as $member)
            <tr id="{{$member->pivot->withdraw_order}}"
                data-order="{{ $member->pivot->withdraw }}">
                <td class="ui-state-default drag-handler">{{ $member->full_name }}</td>
                <td>{{ $member->pivot->quantity}}</td>
                <td>

                    @if($member->pivot->withdraw=='1')
                        <label class="badge badge-success">True</label>
                    @else
                        <label class="badge badge-danger">False</label>
                    @endif

                </td>
                <td>

                    @if($member->pivot->withdraw=='1')
                        <span class="day badge badge-success">{{\Carbon\Carbon::parse($member->pivot->withdraw_date)->format('M')}}</span>
                    @else
                        <span>N/A</span>
                    @endif
                </td>
                <td>
                    @if($member->pivot->withdraw_month==null)
                        <p>N/A</p>
                    @else
                        {{\Carbon\Carbon::parse($member->pivot->withdraw_month)->format('M Y')}}
                    @endif
                </td>
                <td id="with_draw_{{$member->pivot->id}}">
                    @if($member->pivot->withdraw_order==null)
                        <p>N/A</p>
                    @else
                        {{$member->pivot->withdraw_order}}
                    @endif
                </td>
                <td>
                    @if($status->isEmpty())
                        @if($member->pivot->withdraw=='1')
                            <span class="badge badge-success">Withdraw</span>
                        @else
                            @if(Carbon\Carbon::parse($member->pivot->withdraw_month)->format('my')== Carbon\Carbon::now()->format('my'))
                                <a href="{{ route('committee-members.confirm',[$committee->id,$member->id,$member->pivot->id])}}"
                                   role="button" class="btn btn-primary btn-sm">Pay</a>
                            @endif
                        @endif
                    @else
                        <a role="button"
                           class="btn btn-primary btn-sm disabled text-white">Pay</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@section('script')
    <script>
        $("#sortable").sortable({
            start: function (event, ui) {
                var startIndex = $(ui.item).index();
                ui.item.data('start_pos', startIndex);
            },

            stop: function (event, ui) {
                if ($(ui.item).data('order') == 1) {
                    return false;
                }
                var endIndex = $(ui.item).index();
                ui.item.data('stop', endIndex);
                updateOrder(ui.item.data('start_pos'), ui.item.data('stop'));

            },
        });

        function updateOrder(start, stop) {

            var committee_id = '{{ $committee->id}}';
            $.ajax({
                url: "/committee-members/" + committee_id,
                method: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'PATCH',
                    'start': start + 1,
                    'end': stop + 1,
                },
                success: function (response) {
                    $('#drag-drop').replaceWith(response.view);
                    $("#sortable").sortable({
                        start: function (event, ui) {
                            var startIndex = $(ui.item).index();
                            ui.item.data('start_pos', startIndex);
                        },

                        stop: function (event, ui) {
                            if ($(ui.item).data('order') == 1) {
                                return false;
                            }
                            var endIndex = $(ui.item).index();
                            ui.item.data('stop', endIndex);
                            updateOrder(ui.item.data('start_pos'), ui.item.data('stop'));

                        },
                    });
                }

            });
        }

    </script>
@endsection
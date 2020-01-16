<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommitteeMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:committee-members.confirm');
        $this->middleware('permission:committee-members.create', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        return view('admin.committee_members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($committee_id)
    {
        if (\auth()->user()->isMember()) {
            abort(404);
        }
        if (auth()->user()->isAdmin()) {
            $committee = Committee::where('id', $committee_id)->with(['members' => function ($query) {
                $query->orderBy('withdraw_order', 'asc');
            }])->first();
            $members = Member::query()->select('first_name', 'last_name', 'id')->get();
            $status = $committee->members()->wherePivot('status', 'unpaid')->get();
            return view('admin.committee_members.create', compact('committee', 'members', 'status'));
        }
        return redirect(route('committees.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->submit == 'submit') {
            if ($request->get('form') == 'confirm') {
                $committee = Committee::find($request->committee_id);
                $exists = $committee->members()
                    ->wherePivot('id', $request->id)
                    ->where('withdraw', 1)
                    ->exists();
                if ($exists == false) {
                    $committee->members()->wherePivot('id', $request->id)->update([
                        'withdraw_date' => Carbon::now()->toDateTimeString(),
                        'withdraw' => $request->withdraw,
                    ]);
                    return redirect()->route('committee-members.create', [$committee->id]);
                } else {
                    return redirect()->route('committee-members.create', [$committee->id]);
                }
            } else {
                $this->validate($request, [
                    'member_id' => 'required',
                    'quantity' => 'required',
                ]);

                $getCommittee = Committee::find($request->committee_id);
                $count = $getCommittee->members()->count();
                $quantity = \request()->quantity;

                foreach ($getCommittee->members as $member) {
                    $quantity += $member->pivot->quantity;
                }

                if ($count < $getCommittee->total_members && $quantity <= $getCommittee->total_members) {
                    $exists = $getCommittee->members()
                        ->where('committee_id', $request->committee_id)
                        ->where('member_id', $request->member_id)
                        ->first();

                    $perMonth = $getCommittee->amount * $request->quantity;

                    $getCommittee->members()->attach($request->member_id, [
                        'quantity' => \request()->quantity,
                        'amount' => $perMonth,
                    ]);
                } else {
                    return redirect()->back()->with('danger', 'Committee members are full. ');
                }
                return redirect()->route('committee-members.create', [$getCommittee->id]);
            }
        }
        if ($request->withdraw == 'withdraw') {
            $committee = Committee::find($request->committee_id);

            $time1 = strtotime($committee->start_date);
            $time2 = strtotime($committee->end_date);

            $my = date('mY', $time2);
            $months = array(Carbon::parse($time1)->toDateTimeString());

            while ($time1 < $time2) {
                $time1 = strtotime(date('Y-m-d', $time1) . ' +1 month');
                if (date('mY', $time1) != $my && ($time1 < $time2))
                    $months[] = Carbon::parse($time1)->toDateTimeString();
            }

            $months[] = Carbon::parse($time2)->toDateTimeString();

            foreach ($committee->members->shuffle()->take($committee->members->count()) as $key => $member) {
                if ($member->pivot->withdraw_month == null && $member->pivot->withdraw_order == null)
                    $committee->members()->wherePivot('id', $member->pivot->id)->update([
                        'withdraw_month' => $months[$key],
                        'withdraw_order' => $key + 1,
                    ]);
                else {
                    redirect()->route('committee-members.create', [$committee->id])->with('Already-Shuffled', 'This action is already performed');
                }
            }
            return redirect()->route('committee-members.create', [$committee->id]);
        }
    }


    public function confirm($committee_id, $member_id, $id)
    {
        if (auth()->user()->hasRole('admin')) {
            $committee = Committee::query()->findOrFail($committee_id);
            $member = $committee->members()->wherePivot('id', $id)->first();
            return view('admin.committee_members.confirm', compact('committee', 'member'));
        }
        return redirect(route('committees.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Responses
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $committee = Committee::findOrFail($id);

        $firstMember = $committee->members()->wherePivot('withdraw_order', $request->start)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('withdraw_order', $request->end)->first();
        $clone_second_member = clone($secondMember);

        if ($clone_first_member->pivot->withdraw_date == null && $clone_second_member->pivot->withdraw_date == null) {
            $committee->members()->wherePivot('withdraw_order', $request->start)->detach($firstMember->id);
            $committee->members()->wherePivot('withdraw_order', $request->end)->detach($secondMember->id);

            $committee->members()->attach($firstMember, ([
                'quantity' => 1,
                'withdraw_month' => $clone_second_member->pivot->withdraw_month,
                'withdraw_order' => $clone_second_member->pivot->withdraw_order,
                'amount' => $clone_second_member->pivot->amount,
                'status' => $clone_second_member->pivot->status,
                'withdraw' => $clone_second_member->pivot->withdraw,
            ]));

            $committee->members()->attach($secondMember, [
                'quantity' => 1,
                'withdraw_month' => $clone_first_member->pivot->withdraw_month,
                'withdraw_order' => $clone_first_member->pivot->withdraw_order,
                'amount' => $clone_first_member->pivot->amount,
                'status' => $clone_first_member->pivot->status,
                'withdraw' => $clone_first_member->pivot->withdraw,
            ]);
            $committee = Committee::where('id', $id)->with(['members' => function ($q) {
                $q->orderBy('withdraw_order', 'asc');
            }])->first();
            $status = $committee->members()->wherePivot('status', 'unpaid')->get();
        }
        return response()->json(['success' => true, 'view' => (string)view('admin.committee_members.partials.table', compact('committee', 'status'))]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

<?php

namespace App\Http\Controllers;

use App\Committee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CommitteeReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = Committee::all();
        return view('admin.report.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request)
    {

        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        if ($request->start_date != null && $request->end_date != null) {
            $startDate = Carbon::parse($request->get('start_date'))->toDateTimeString();
            $endDate = Carbon::parse($request->get('end_date'))->toDateTimeString();
            $results = Committee::query()
                ->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->get();

            return response()->json($results);
//            return ['redirect' => view('admin.report.search', compact('searchedCommittees'))];
//            return view('admin.report.search', compact('searchedCommittees'));
        } else {
            return redirect()->route('committee-reports.index')->with('not-found', 'Search is empty!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $committee = Committee::findOrFail($id);
        return view('admin.report.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable($committee_id)
    {
        $committee = Committee::findOrFail($committee_id);
        $members = $committee->members()->wherePivot('committee_id', $committee_id)->get();

        return Datatables::of($members)
            ->editColumn('full_name', function ($member) {
                return $member->full_name;
            })->editColumn('quantity', function ($member) {
                return $member->pivot->quantity;
            })->editColumn('amount', function ($member) {
                return $member->pivot->amount;
            })->editColumn('withdraw_date', function ($member) {
                if ($member->pivot->withdraw == '1') {
                    return '<span class="day badge badge-success">' . Carbon::parse($member->pivot->withdraw_date)->format('M') . '</span>';

                } else {
                    return 'N/A';
                }
            })
            ->rawColumns(['full_name', 'quantity', 'amount', 'withdraw_date'])->make(true);
    }
}

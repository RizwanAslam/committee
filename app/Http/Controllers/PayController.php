<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Pay;
Use \Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($committee_id, $member_id, $id)
    {
        if (auth()->user()->hasRole('admin')) {
            $committee = Committee::query()->findOrFail($committee_id);
            $member = $committee->members()->wherePivot('id', $id)->first();
            return view('admin.committee_members.pay', compact('committee', 'member'));
        }
        return redirect(route('committees.index'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $committee = Committee::find($request->committee_id);
        $exist = $committee->members()
            ->wherePivot('id', $request->id)
            ->where('status', 'unpaid')
            ->exists();

        if ($exist == true) {
            $data = Pay::query()->create([
                'company_id' => auth()->user()->company_id,
                'committee_id' => $request->committee_id,
                'member_id' => $request->member_id,
                'date' => Carbon::now()->toDateTimeString(),
                'amount' => $request->member_amount,
                'quantity' => $request->member_quantity,
            ]);
            $committee->members()->wherePivot('id', $request->id)->update([
                'status' => $request->status,
                'monthly_withdraw_date' => Carbon::now()->toDateTimeString(),

            ]);
        }
        return redirect(route('committees.show', $committee->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}

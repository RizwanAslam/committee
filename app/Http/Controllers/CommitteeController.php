<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Http\Requests\CommitteeRequest;
use App\Pay;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;
use Yajra\DataTables\DataTables;
use DateTime;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $committee = Committee::all();
        return view('admin.committees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('admin.committees.create');
        }
        return redirect(route('committees.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommitteeRequest $request)
    {
        //$user->roles()->attach(Role::where('role_desc', 'Superadmin')->get('id')->first());

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $withDrawAmount = $request->total_members * $request->amount;

        Committee::query()->create([
            'name' => $request->name,
            'start_date' => $start_date->toDateTimeString(),
            'end_date' => $end_date->toDateTimeString(),
            'duration' => $start_date->diffInMonths($end_date),
            'total_members' => $request->total_members,
            'withDraw_amount' => $withDrawAmount,
            'amount' => $request->amount,
        ]);
        return redirect(route('committees.index'));
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
        $members = $committee->members()->whereMonth('committee_member.created_at', Carbon::now()->month)->get();
        return view('admin.committees.show', compact('committee', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $committee = Committee::find($id);
            return view('admin.committees.edit', compact('committee'));
        }
        return redirect(route('committees.index'));
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
        $committee = Committee::findOrFail($id);
        $committee->update([
            'name' => $request->name,
        ]);
        return redirect(route('committees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $committee = Committee::findOrFail($id);
            $committee->delete();
            return redirect(route('committees.index'));
        }
        return redirect(route('committees.index'));
    }

    public function datatable()
    {
        if (auth()->user()->hasRole('admin'))
            $committees = Committee::query();
        else
            $committees = Committee::whereHas('members', function ($query) {
                $query->where('members.id', auth()->user()->id);
            });
        return Datatables::of($committees)
            ->editColumn('name', function ($committee) {
                return str_limit($committee->name, $limit = 10, $end = '...');
            })
            ->editColumn('start_date', function ($committee) {
                return Carbon::parse($committee->start_date)->format('d-m-y');
            })
            ->editColumn('end_date', function ($committee) {
                return Carbon::parse($committee->end_date)->format('d-m-y');
            })
            ->editColumn('duration', function ($committee) {
                return $committee->duration;
            })
            ->editColumn('total_members', function ($committee) {
                return $committee->total_members;
            })
            ->editColumn('withDraw_amount', function ($committee) {
                return $committee->withDraw_amount;
            })
            ->editColumn('amount', function ($committee) {
                return $committee->amount;
            })
            ->addColumn('actions', function ($committee) {
                return view('admin.committees.partials.actions', compact('committee'));
            })->rawColumns(['name', 'start_date', 'end_date', 'duration', 'total_members', 'withDraw_amount', 'amount', 'actions'])->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Http\Requests\MemberRequest;
use App\Member;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        Member::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'cnic' => $request->cnic,
            'address' => $request->address
        ]);
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
        ]);
        $member = Member::findOrFail($id);
        $member->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address
        ]);
        return redirect(route('members.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect(route('members.index'));
    }

    public function detail($committee_id, $member_id)
    {
        $committee = Committee::findOrFail($committee_id);
        $member = $committee->members()->wherePivot('member_id', $member_id)->first();
        return view('admin.members.detail', compact('committee', 'member'));
    }

    public function datatable()
    {
        $members = Member::select('id', 'first_name', 'last_name', 'email', 'cnic', 'address');
        return Datatables::of($members)
            ->editColumn('first_name', function ($member) {
                return $member->first_name;
            })
            ->editColumn('last_name', function ($member) {
                return $member->last_name;
            })
            ->editColumn('email', function ($member) {
                return $member->email;
            })
            ->editColumn('cnic', function ($member) {
                return $member->cnic;
            })
            ->editColumn('address', function ($member) {
                return $member->address;
            })
            ->addColumn('actions', function ($member) {
                return view('admin.members.partials.actions', compact('member'));
            })->rawColumns(['first_name', 'last_name', 'email', 'cnic', 'address', 'actions'])->make(true);
    }

}
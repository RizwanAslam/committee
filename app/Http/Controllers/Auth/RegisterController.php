<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Http\Controllers\Controller;
use App\Member;
use App\Scopes\CompanyScope;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
//        $this->middleware('permission:register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'cnic' => 'required|min:15|max:15',
            'address' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Member
     */
    protected function create(array $data)
    {
        if (Member::query()->where('email', $data['email'])->withoutGlobalScope(CompanyScope::class)->exists()) {
            $member = Member::where('email', $data['email'])->withoutGlobalScope(CompanyScope::class)->first();
            $company = Company::create([
                'name' => $data['first_name']
            ]);

            $member->update(['password' => Hash::make($data['password'])]);

            $role = Role::updateOrCreate(['name' => 'admin']);
            $member->assignRole($role);

            $member->companies()->syncWithoutDetaching([$company->id => ['role_id' => $role->id]]);

        } else {
            $company = Company::create([
                'name' => $data['first_name']
            ]);

            $member = Member::create([
                'company_id' => $company->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'cnic' => $data['cnic'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
            ]);

            $role = Role::updateOrCreate(['name' => 'admin']);
            $member->assignRole($role);

            $member->companies()->sync([$company->id => ['role_id' => $role->id]]);
        }
        return $member;
    }
}

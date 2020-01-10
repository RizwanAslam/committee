<?php

use App\Member;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = \App\Company::create([
            'name' => 'software house',
        ]);
        $member = Member::create([
            'company_id' => $company->id,
            'first_name' => 'Hammad',
            'last_name' => 'Soby',
            'email' => 'hammad@codebrisk.com',
            'cnic' => '34634-2342342-3',
            'address' => 'satellite town sargodha',
            'password' => bcrypt('12345678'),
        ]);

        $role = Role::query()->where('name', 'admin')->first();
        $member->assignRole($role);

        $member->companies()->sync([$company->id => ['role_id' => $role->id]]);

    }
}

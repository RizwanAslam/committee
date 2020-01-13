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

        $member_admin = Member::create([
            'company_id' => $company->id,
            'first_name' => 'Hammad',
            'last_name' => 'Soby',
            'email' => 'hammad@codebrisk.com',
            'cnic' => '34634-2342342-3',
            'address' => 'satellite town sargodha',
            'password' => bcrypt('12345678'),
        ]);

        $role_admin = Role::query()->where('name', 'admin')->first();
        $member_admin->assignRole($role_admin);
        $member_admin->companies()->sync([$company->id => ['role_id' => $role_admin->id]]);

        $role_member = Role::create(['name' => 'member']);

        $members = [
            ['company_id' => $company->id,
                'first_name' => 'Bilal',
                'last_name' => 'Mahar',
                'email' => 'bilal@codebrisk.com',
                'cnic' => '34634-2333332-3',
                'address' => 'Sattelite town sargodha',
                'password' => bcrypt('12345678'),
            ],
            ['company_id' => $company->id,
                'first_name' => 'Fahad',
                'last_name' => 'Khan',
                'email' => 'fahad@codebrisk.com',
                'cnic' => '34634-2555542-3',
                'address' => 'Sattelite town sargodha',
                'password' => bcrypt('12345678'),
            ],
            [
                'company_id' => $company->id,
                'first_name' => 'Adnan',
                'last_name' => 'Shehzad',
                'email' => 'adnan@codebrisk.com',
                'cnic' => '34634-2344442-3',
                'address' => 'Tali chowk sargodha',
                'password' => bcrypt('12345678'),
            ],
            [
                'company_id' => $company->id,
                'first_name' => 'Rizwan',
                'last_name' => 'Aslam',
                'email' => 'rizwan@codebrisk.com',
                'cnic' => '34634-2311112-3',
                'address' => 'Mohafiz town sargodha',
                'password' => bcrypt('12345678'),
            ],
            [
                'company_id' => $company->id,
                'first_name' => 'Umer Aslam',
                'last_name' => 'Raza',
                'email' => 'umeraslamraza1@gmail.com',
                'cnic' => '34634-2347742-3',
                'address' => 'Green homes sargodha',
                'password' => bcrypt('12345678'),
            ],
            [
                'company_id' => $company->id,
                'first_name' => 'Muhammad',
                'last_name' => 'Awais',
                'email' => 'awais@codebrisk.com',
                'cnic' => '34634-2399442-3',
                'address' => 'Sattelite town sargodha',
                'password' => bcrypt('12345678'),
            ],
        ];
        foreach ($members as $member) {
            $member_is = Member::create($member);
            $member_is->assignRole($role_member);
            $member_is->companies()->sync([$company->id => ['role_id' => $role_member->id]]);
        }

    }
}

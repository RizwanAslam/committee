<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $member = factory(\App\Member::class)->create([
            'first_name' => 'Hammad',
            'last_name' => 'Soby',
            'email' => 'hammad@codebrisk.com',
            'cnic' => '34634-2342342-3',
            'address' => 'satellite town sargodha',
            'password' => bcrypt('12345678'),
        ]);

        $role = Role::query()->where('name', 'admin')->first();

        $member->assignRole($role);
    }
}

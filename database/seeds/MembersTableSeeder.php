<?php

use App\Committee;
use App\Member;
use App\Pay;
use Carbon\Carbon;
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

        $start_date = Carbon::parse('09/01/2019');
        $end_date = Carbon::parse('07/01/2020');

        $committee = Committee::query()->create([
            'company_id' => $company->id,
            'name' => 'Software house',
            'start_date' => $start_date->toDateTimeString(),
            'end_date' => $end_date->toDateTimeString(),
            'duration' => 10,
            'total_members' => 10,
            'withDraw_amount' => 100000,
            'amount' => 10000,
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
            [
                'company_id' => $company->id,
                'first_name' => 'Rizwan',
                'last_name' => 'Aslam',
                'email' => 'rizwan@codebrisk.com',
                'cnic' => '34634-2311112-3',
                'address' => 'Mohafiz town sargodha',
                'password' => bcrypt('12345678'),
            ],
            ['company_id' => $company->id,
                'first_name' => 'Bilal',
                'last_name' => 'Mahar',
                'email' => 'bilal@codebrisk.com',
                'cnic' => '34634-2333332-3',
                'address' => 'Sattelite town sargodha',
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
                'first_name' => 'Adnan',
                'last_name' => 'Shehzad',
                'email' => 'adnan@codebrisk.com',
                'cnic' => '34634-2344442-3',
                'address' => 'Tali chowk sargodha',
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
                'first_name' => 'Muhammad',
                'last_name' => 'Awais',
                'email' => 'awais@codebrisk.com',
                'cnic' => '34634-2399442-3',
                'address' => 'Sattelite town sargodha',
                'password' => bcrypt('12345678'),
            ],
        ];
        $time1 = strtotime($committee->start_date);
        $time2 = strtotime($committee->end_date);

        $my = date('mY', $time2);
        $months = array(\Illuminate\Support\Carbon::parse($time1)->toDateTimeString());

        while ($time1 < $time2) {
            $time1 = strtotime(date('Y-m-d', $time1) . ' +1 month');
            if (date('mY', $time1) != $my && ($time1 < $time2))
                $months[] = Carbon::parse($time1)->toDateTimeString();
        }

        $months[] = Carbon::parse($time2)->toDateTimeString();

        foreach ($members as $member) {
            $member_is = Member::create($member);
            $member_is->assignRole($role_member);
            $member_is->companies()->sync([$company->id => ['role_id' => $role_member->id]]);
            $member_is->committees()->attach($committee->id, [
                'quantity' => 1,
                'amount' => 10000,
            ]);
            if ($member_is['email'] == 'adnan@codebrisk.com') {
                $member_is->committees()->attach($committee->id, [
                    'member_id' => $member_is->id,
                    'quantity' => 1,
                    'amount' => 10000,
                ]);
            }
            if ($member_is['email'] == 'rizwan@codebrisk.com') {
                $member_is->committees()->attach($committee->id, [
                    'member_id' => $member_is->id,
                    'quantity' => 1,
                    'amount' => 10000,
                ]);
            }
            if ($member_is['email'] == 'umeraslamraza1@gmail.com') {
                $member_is->committees()->attach($committee->id, [
                    'member_id' => $member_is->id,
                    'quantity' => 1,
                    'amount' => 10000,
                ]);
            }
        }

        $member_admin->committees()->attach($committee->id, [
            'member_id' => $member_admin->id,
            'quantity' => 1,
            'amount' => 10000,
        ]);
        foreach ($committee->members as $key => $member) {
            if ($member->pivot->withdraw_month == null && $member->pivot->withdraw_order == null)
                $committee->members()->wherePivot('id', $member->pivot->id)->update([
                    'withdraw_month' => $months[$key],
                    'withdraw_order' => $key + 1,
                ]);
        }
        $firstMember = $committee->members()->wherePivot('id', 5)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('id', 6)->first();
        $clone_second_member = clone($secondMember);

        $committee->members()->wherePivot('id', 5)->detach($firstMember->id);
        $committee->members()->wherePivot('id', 6)->detach($secondMember->id);

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

        $firstMember = $committee->members()->wherePivot('id', 2)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('id', 3)->first();
        $clone_second_member = clone($secondMember);

        $committee->members()->wherePivot('id', 2)->detach($firstMember->id);
        $committee->members()->wherePivot('id', 3)->detach($secondMember->id);

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
        $firstMember = $committee->members()->wherePivot('id', 13)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('id', 11)->first();
        $clone_second_member = clone($secondMember);

        $committee->members()->wherePivot('id', 13)->detach($firstMember->id);
        $committee->members()->wherePivot('id', 11)->detach($secondMember->id);

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
        $firstMember = $committee->members()->wherePivot('id', 7)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('id', 4)->first();
        $clone_second_member = clone($secondMember);

        $committee->members()->wherePivot('id', 7)->detach($firstMember->id);
        $committee->members()->wherePivot('id', 4)->detach($secondMember->id);

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
        $firstMember = $committee->members()->wherePivot('id', 12)->first();
        $clone_first_member = clone($firstMember);

        $secondMember = $committee->members()->wherePivot('id', 15)->first();
        $clone_second_member = clone($secondMember);

        $committee->members()->wherePivot('id', 12)->detach($firstMember->id);
        $committee->members()->wherePivot('id', 15)->detach($secondMember->id);

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

        foreach ($committee->members as $key => $member) {
            $idz = $committee->members()->pluck('committee_member.id');
            $data = Pay::query()->create([
                'company_id' => $company->id,
                'committee_id' => $committee->id,
                'member_id' => $member->id,
                'date' => Carbon::now()->toDateTimeString(),
                'amount' => 10000,
                'quantity' => 1,
            ]);
            $committee->members()->wherePivot('id', $idz[$key])->update([
                'status' => 'paid',
                'monthly_withdraw_date' => Carbon::now()->toDateTimeString(),
            ]);
        }
        $committee->members()->wherePivot('id', 10)->update([
            'withdraw_date' => Carbon::parse('09/01/2019')->toDateTimeString(),
            'withdraw' => 1,
        ]);
        $committee->members()->wherePivot('id', 14)->update([
            'withdraw_date' => Carbon::parse('11/01/2019')->toDateTimeString(),
            'withdraw' => 1,
        ]);
        $committee->members()->wherePivot('id', 16)->update([
            'withdraw_date' => Carbon::parse('12/01/2019')->toDateTimeString(),
            'withdraw' => 1,
        ]);
        $committee->members()->wherePivot('id', 1)->update([
            'withdraw_date' => Carbon::parse('10/01/2019')->toDateTimeString(),
            'withdraw' => 1,
        ]);
        $committee->members()->wherePivot('id', 17)->update([
            'withdraw_date' => Carbon::parse('01/01/2020')->toDateTimeString(),
            'withdraw' => 1,
        ]);
    }
}

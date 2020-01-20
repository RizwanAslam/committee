<?php

namespace App\Console\Commands;

use App\Committee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MonthlyDuplicate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:duplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All members of committee pay monthly. Duplicate the entries.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $committees = Committee::all();
        $endDate = Carbon::now()->toDateTimeString();
        foreach ($committees as $committee) {
            if ($endDate < $committee->end_date) {
                foreach ($committee->members as $member) {
//                    \Log::info('Member => ' . $member->pivot->quantity);
                    $committee->members()->attach($member, [
                        'quantity' => $member->pivot->quantity,
                        'amount' => $member->pivot->amount,
                        'status' => 'unpaid',
                        'withdraw_date' => $member->pivot->withdraw_date,
                        'withdraw' => $member->pivot->withdraw,
                    ]);
                }
            } else {

            }
        }
    }
}

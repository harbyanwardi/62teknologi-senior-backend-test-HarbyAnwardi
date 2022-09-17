<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class RechargeCredit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recharge:credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recharge Credit Point for Customer';

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
     * @return int
     */
    public function handle()
    {
        $users = User::where('type', '!=', 'owner')->get();
        foreach ($users as $user ) {
            if($user->type == 'reguler') {
                $credit = 20;
            } else {
                $credit = 40;
            }
            $data = array(
                "credit" => $credit,
            );
            $user = User::find($user->id);
            $user->fill($data);
            $user->save();
        }

    }
}

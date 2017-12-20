<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Db;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Name Change Successfully';

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
        //
         \DB::table('cart_items')
            ->where('updated', 0)
            //->update(['name' => str_random(10)]);
             ->update(['updated' => 1]);

    	$this->info('User Name Change Successfully!');

        $connection2 = DB::connection('mysql2');
        $medicineCompanyList = $connection2->table('cart_items')
                            ->where('updated', 0)
                            ->update(['updated' => 1]);

    }
}

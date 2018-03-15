<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
		Commands\CustomCommand::class,
		Commands\IncompletePayClear::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->everyMinute();//*/
				 
        $schedule->command('incomplete_pay:clear')->everyMinute();//*/
			
/*        $schedule->call(function() {
			echo "id=";
			
/*			$id = DB::table("cash")
			->insertGetId(['InHandCash'=>"100",'PettyCash'=>'200','BID'=>'7']);
			echo $id;
		})->everyMinute();
		echo "---";//*/
    }
}

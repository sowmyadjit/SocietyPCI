<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ReveresEntryController;

class IncompletePayClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incomplete_pay:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
	protected $ipcc; 
	
    public function __construct(ReveresEntryController $ipcc)
    {
        parent::__construct();
		$this->ipc = $ipcc;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		
		echo "executing cmd ";
		$this->ipc->sh();
    }
}

<?php

namespace Muserpol\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
//use Log;

class ImportacionesBases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alucarth:ImportacionesBases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commando alucarth';

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
        $this->info("Execute XD ........ >");
        // $policias = DB::table('policias')->get();
       $roles = DB::connection('mysql')->table('roles')->get();

      // $policias = DB::connection('mysql')->table('policias')->get();


        // Log::info($policias);

        $this->info(json_encode($roles));

        $this->info("<Finally Commnad>");

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteReadNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read-notification:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove seen notification order than 5 days ago';

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
        DB::table('notifications')->whereNotNull('read_at')->
        where('read_at' ,'<=' , now()->subDays(5)->toDateTimeString())->delete();
    }
}

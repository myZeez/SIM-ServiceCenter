<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackfillCompletedAt extends Command
{
    protected $signature = 'app:backfill-completed-at';
    protected $description = 'Backfill completed_at for Done/Taken services';

    public function handle()
    {
        $count = \Illuminate\Support\Facades\DB::table('services')
            ->whereIn('status', ['Done', 'Taken'])
            ->whereNull('completed_at')
            ->update(['completed_at' => \Illuminate\Support\Facades\DB::raw('updated_at')]);

        $this->info("Backfilled {$count} records.");
    }
}

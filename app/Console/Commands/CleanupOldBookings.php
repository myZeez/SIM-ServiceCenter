<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CleanupOldBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cleanup {--days=7 : Number of days to keep bookings}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete bookings older than specified days (default: 7 days)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $cutoffDate = now()->subDays($days);

        // Delete old pending bookings (not confirmed/converted to service)
        $deletedCount = Booking::where('status', 'pending')
            ->where('created_at', '<', $cutoffDate)
            ->delete();

        $this->info("Deleted {$deletedCount} bookings older than {$days} days.");

        // Log the cleanup
        \Log::info("Booking cleanup: Deleted {$deletedCount} bookings older than {$days} days.");

        return Command::SUCCESS;
    }
}

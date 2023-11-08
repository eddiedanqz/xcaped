<?php

namespace App\Jobs;

use App\Actions\GetEndedEvents;
use App\Actions\UpdateWithdrawals;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWithdrawals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $endedEvents = new GetEndedEvents;

        $update = new UpdateWithdrawals;

        $events = $endedEvents->execute();

        $update->execute($events);
    }
}

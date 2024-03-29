<?php

namespace App\Console;

use App\Console\Commands\AddJobEvent;
use App\Console\Commands\ConvertAdressToLatLongCommand;
use App\Console\Commands\FireEvent;
use App\Console\Commands\SyncWatchCommand;
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
        FireEvent::class,
        SyncWatchCommand::class,
        AddJobEvent::class,
        ConvertAdressToLatLongCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('convert_address')
            ->everyMinute();
    }
}

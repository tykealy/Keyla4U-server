<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Pitch;
use App\Models\Pitct_avalible_time;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // get all pitches
            $pitches = Pitch::all();
            foreach ($pitches as $pitch) {
                // get court open and close times
                $court = Court::find($pitch->court_id);
                $openTime = $court->open_time;
                $closeTime = $court->close_time;
                // delete available time slots for today
                Pitct_avalible_time::where('pitch_id', $pitch->id)
                    ->where('week_day', Carbon::yesterday())
                    ->delete();

                // generate available time slots 
                    $date = Carbon::tomorrow()->addDays(7);
                    //$dayOfWeek = $date->dayOfWeek;
                    $dayOfWeek = $date;

                    for ($time = $openTime; $time < $closeTime; $time++) {
                        // create available time slot for this day and time
                        $availableTime = new Pitct_avalible_time();
                        $availableTime->pitch_id = $pitch->id;
                        $availableTime->week_day = $dayOfWeek;
                        $availableTime->start_time = $time;
                        $availableTime->end_time = $time + 1;
                        $availableTime->save();
                    }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

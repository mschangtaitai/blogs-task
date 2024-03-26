<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\BlogNotification;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            error_log("Schedule!");
            $blogs = Blog::with('user')->whereDate('available_at', '>', Carbon::now())->whereDate('available_at', '<', Carbon::now()->addHour())->all();
            foreach ($blogs as $blog) {

                Mail::to($blog->user->email)->send(new BlogNotification($blog));
            }
        })->everyFiveSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

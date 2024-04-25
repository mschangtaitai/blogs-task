<?php

namespace App\Console\Commands;

use App\Mail\BlogNotification;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending email notifications';

    /**
     * Execute the console command.
     */
    public function handle() {

        $blogs = Blog::with('user')->whereDate('available_at', '>', Carbon::now())->whereDate('available_at', '<=', Carbon::now()->addHour())->all();
        // $blogs = Blog::where('id', 1)->get();
        foreach ($blogs as $blog) {

            Mail::to($blog->user->email)->send(new BlogNotification($blog));
        }
    }
}

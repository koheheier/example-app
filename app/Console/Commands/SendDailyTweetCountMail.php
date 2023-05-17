<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Mail\DailyTweetCount;
use App\Services\TweetService;


class SendDailyTweetCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-tweet-count-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日のつぶやき数を集計してつぶやきを促すメールを送ります';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $count = TweetService::getYesterdayTweetCount();
        $users = User::get();
        foreach($users as $user) {
            Mail::to($user)->send(new DailyTweetCount($count, $user));
            echo "動いてる？";
        }
    }
}

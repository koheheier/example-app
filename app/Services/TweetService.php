<?php
namespace App\Services;
use App\Models\Tweet;
use Carbon\Carbon;

class TweetService
{
    /**
     * tweetを新しい順で全件取得
     */
    public function getTweet()
    {
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
    }

    // userIdのuserのtweetであるかどうかチェック
    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        // そもそもtweetが存在しない場合
        if(!$tweet)
        {
            return false;
            exit;
        }
        return $tweet->user_id === $userId;
    }

    public static function getYesterdayTweetCount() {
        $a = Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
        ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())->count();
        echo $a;
        return $a;
    }
}

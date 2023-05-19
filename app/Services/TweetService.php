<?php
namespace App\Services;
use App\Models\Tweet;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function saveTweet(int $userId, string $content, array $images)
    {
        DB::transaction(
            // use は、関数外で定義した変数を利用する時に使われる。
            function () use ($userId, $content, $images) {
                $tweet = new Tweet;
                $tweet->user_id = $userId;
                $tweet->content = $content;
                $tweet->save();
                foreach ($images as $image) {
                    Storage::putFile('public/images', $image);
                    $imageModel = new Image();
                    $imageModel->name = $image->hashName();
                    $imageModel->save();
                    $tweet->images()->attach($imageModel->id);
                }
            }
        );
    }

    public function deleteTweet(int $tweetId)
    {
        // use は、関数外で定義した変数を利用する時に使われる。
        DB::transaction( function () use ($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            $tweet->images()->each( function ($image) use ($tweet){
                $filePath = 'public/images/' . $image->name;
                if (Storage::exists($filePath)) {
                    $tweet->images()->detach($image->id);
                    $image->delete();
                }
            });
            $tweet->delete();
        });
    }


}

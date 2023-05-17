<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweetId = (int)$request->route('tweetId');
        // dd は、値の確認用として利用することができる。var_dump的な使い方かな
        

        
        // 貴様のtweetではない！
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) 
        {
            throw new AccessDeniedHttpException();
        }
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        
        // if(is_null($tweet))
        // {
        //     throw new NotFoundHttpException('ツイートが存在しません');
        // }
        return view('tweet.update')->with('tweet', $tweet);
    }
}

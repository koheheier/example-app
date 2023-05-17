<?php
namespace App\Http\Controllers\Tweet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;
use App\Models\Tweet;
use App\Services\TweetService;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * Factory $factory
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {

        
        $tweets = $tweetService->getTweet();
        // $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        // $tweets = Tweet::all()->sortByDesc('created_at')でも可

        // エラーの画面を利用して、取得データを見ることもできる。ddでは引数に指定した値しか見れないが、意図的にエラー画面を出すことでクエリを確認したりと、オプションがある
        // dump($tweets);
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dump report.'));

        return view("tweet.index")->with(["name" => 'laravel'])->with(["end" => 'おわり！'])->with("tweets", $tweets);
        // return $factory->make("tweet.index", ["name" => 'laravel']);
        // return View::make("tweet.index", ["name" => 'laravel']);
        // return view("tweet.index", ["name" => 'laravel']);
    }
}

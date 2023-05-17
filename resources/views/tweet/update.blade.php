<!doctype html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta namse="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
                 maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>つぶやきあぷり</title>
</head>
<body>
    <h1>つぶやきあるぷ</h1><br>

    <div>
        <a href="{{ route('tweet.index') }}"> ＜戻る </a>
        <p>投稿フォーム</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('tweet.update.put', ['tweetId' => $tweet->id]) }}" method="post">
            @method('PUT')
            @csrf
            <label for="tweet-content">つぶやけ</label>
            <span>140文字まで</span>
            <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力しよう">{{ $tweet->content }}</textarea>
            @error('tweet')
            <p style="color: red">{{ $message }}</p>
            @enderror
            <button type="submit">編集</button>
        </form>
    </div>
</body>




